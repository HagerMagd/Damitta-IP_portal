<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\committee;
use App\Models\CommitteeMember;
use App\Utlis\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Throwable;

class EthicsCommitteeMemberController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403);
    }

    /**
     * Display ethics committee members.
     */
    public function index(Request $request)
    {
        $this->ensureAdmin();

        $query = User::with([
            'specialization',
            'committeeMembers.committee.specialization',
        ])->where('role', 'ethics_member');

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->status === 'active') {
            $query->where('status', false);
        } elseif ($request->status === 'restricted') {
            $query->where('status', true);
        }

        $members = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics for ethics members only
        $totalMembers = User::where('role', 'ethics_member')->count();

        $activeMembers = User::where('role', 'ethics_member')
            ->where('status', false)
            ->count();

        $restrictedMembers = User::where('role', 'ethics_member')
            ->where('status', true)
            ->count();

        // Only ethics committees can be assigned here
        $committees = committee::with('specialization')
            ->where('type', 'ethics')
            ->orderBy('name')
            ->get();

        return view('dashboard.admin.ethics-committee-members.index', compact(
            'members',
            'committees',
            'totalMembers',
            'activeMembers',
            'restrictedMembers'
        ));
    }

    /**
     * Store a new ethics committee member.
     */
    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'committee_id' => [
                'required',
                'integer',
                Rule::exists('committees', 'id')
                    ->where('type', 'ethics'),
            ],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = ImageManager::uploadImage(
                $request->file('image'),
                'ethics-committee-members'
            );
        }

        try {
            DB::transaction(function () use ($validated, $imagePath) {
                $assignedCommittee = committee::findOrFail(
                    $validated['committee_id']
                );

                $member = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'ethics_member',
                    'status' => false,
                    'specialization_id' => $assignedCommittee->specialization_id,
                    'image_path' => $imagePath,
                ]);

                CommitteeMember::create([
                    'user_id' => $member->id,
                    'committee_id' => $assignedCommittee->id,
                ]);
            });
        } catch (Throwable $exception) {
            if ($imagePath) {
                ImageManager::deleteimage($imagePath);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.ethics-committee-members.index')
            ->with('success', 'Ethics committee member added successfully.');
    }

    /**
     * Update an ethics committee member.
     */
    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'ethics_member', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'committee_id' => [
                'required',
                'integer',
                Rule::exists('committees', 'id')
                    ->where('type', 'ethics'),
            ],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $oldImagePath = $user->image_path;
        $newImagePath = null;

        if ($request->hasFile('image')) {
            $newImagePath = ImageManager::uploadImage(
                $request->file('image'),
                'ethics-committee-members'
            );
        }

        try {
            DB::transaction(function () use (
                $user,
                $validated,
                $newImagePath
            ) {
                $assignedCommittee = committee::findOrFail(
                    $validated['committee_id']
                );

                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->specialization_id =
                    $assignedCommittee->specialization_id;

                if (!empty($validated['password'])) {
                    $user->password = Hash::make($validated['password']);
                }

                if ($newImagePath) {
                    $user->image_path = $newImagePath;
                }

                $user->save();

                // This page assigns one committee per member.
                CommitteeMember::where('user_id', $user->id)->delete();

                CommitteeMember::create([
                    'user_id' => $user->id,
                    'committee_id' => $assignedCommittee->id,
                ]);
            });
        } catch (Throwable $exception) {
            if ($newImagePath) {
                ImageManager::deleteimage($newImagePath);
            }

            throw $exception;
        }

        if ($newImagePath && $oldImagePath) {
            ImageManager::deleteimage($oldImagePath);
        }

        return redirect()
            ->route('admin.ethics-committee-members.index')
            ->with('success', 'Ethics committee member updated successfully.');
    }

    /**
     * Activate or restrict a member.
     */
    public function toggleStatus(User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'ethics_member', 404);

        if (Auth::id() === $user->id) {
            return back()->with(
                'error',
                'You cannot change your own account status.'
            );
        }

        $user->status = !$user->status;
        $user->save();

        $message = $user->status
            ? 'Ethics committee member restricted successfully.'
            : 'Ethics committee member activated successfully.';

        return back()->with('success', $message);
    }
}
