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

class CommitteeMemberController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403);
    }

    /**
     * Display committee members.
     */
    public function index(Request $request)
    {
        $this->ensureAdmin();

        $query = User::with([
            'specialization',
            'committeeMembers.committee',
        ])->where('role', 'committee_member');

        // Search by name or email.
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status.
        if ($request->status === 'active') {
            $query->where('status', false);
        } elseif ($request->status === 'restricted') {
            $query->where('status', true);
        }

        $members = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics for all committee members.
        $totalMembers = User::where('role', 'committee_member')
            ->count();

        $activeMembers = User::where('role', 'committee_member')
            ->where('status', false)
            ->count();

        $restrictedMembers = User::where('role', 'committee_member')
            ->where('status', true)
            ->count();

        // Available committees for the add/edit forms.
        $committees = committee::with('specialization')
            ->orderBy('name')
            ->get();

        return view(
            'dashboard.admin.committee-members.index',
            compact(
                'members',
                'committees',
                'totalMembers',
                'activeMembers',
                'restrictedMembers'
            )
        );
    }

    /**
     * Create a committee member.
     */
    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'committee_id' => [
                'required',
                'exists:committees,id',
            ],

            'image' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);

        $imagePath = null;

        // Upload the image through the reusable ImageManager.
        if ($request->hasFile('image')) {
            $imagePath = ImageManager::uploadImage(
                $request->file('image'),
                'committee-members'
            );
        }

        try {
            DB::transaction(function () use ($validated, $imagePath) {
                $selectedCommittee = committee::findOrFail(
                    $validated['committee_id']
                );

                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'committee_member',

                    // false = active, true = restricted.
                    'status' => false,

                    // Use the specialization belonging to the committee.
                    'specialization_id' =>
                        $selectedCommittee->specialization_id,

                    'image_path' => $imagePath,
                ]);

                CommitteeMember::create([
                    'committee_id' => $selectedCommittee->id,
                    'user_id' => $user->id,
                ]);
            });
        } catch (\Throwable $exception) {
            // Avoid leaving an uploaded image if saving fails.
            if ($imagePath) {
                ImageManager::deleteimage($imagePath);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.committee-members.index')
            ->with('success', 'Committee member added successfully.');
    }

    /**
     * Update a committee member.
     */
    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'committee_member', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
            ],

            'committee_id' => [
                'required',
                'exists:committees,id',
            ],

            'image' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);

        $oldImagePath = $user->image_path;
        $newImagePath = null;

        // Upload a replacement image only if one was provided.
        if ($request->hasFile('image')) {
            $newImagePath = ImageManager::uploadImage(
                $request->file('image'),
                'committee-members'
            );
        }

        try {
            DB::transaction(function () use (
                $validated,
                $user,
                $newImagePath
            ) {
                $selectedCommittee = committee::findOrFail(
                    $validated['committee_id']
                );

                $user->name = $validated['name'];
                $user->email = $validated['email'];

                $user->specialization_id =
                    $selectedCommittee->specialization_id;

                // Keep the existing password if no new one was entered.
                if (!empty($validated['password'])) {
                    $user->password = Hash::make(
                        $validated['password']
                    );
                }

                if ($newImagePath) {
                    $user->image_path = $newImagePath;
                }

                $user->save();

                /*
                 * This page assigns one committee per member.
                 * Replace the current membership with the selected one.
                 */
                CommitteeMember::where('user_id', $user->id)->delete();

                CommitteeMember::create([
                    'committee_id' => $selectedCommittee->id,
                    'user_id' => $user->id,
                ]);
            });
        } catch (\Throwable $exception) {
            if ($newImagePath) {
                ImageManager::deleteimage($newImagePath);
            }

            throw $exception;
        }

        // Delete the previous image only after the update succeeds.
        if ($newImagePath && $oldImagePath) {
            ImageManager::deleteimage($oldImagePath);
        }

        return redirect()
            ->route('admin.committee-members.index')
            ->with('success', 'Committee member updated successfully.');
    }

    /**
     * Activate or restrict a committee member.
     */
    public function toggleStatus(User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'committee_member', 404);

        if ($user->id === Auth::id()) {
            return back()->with(
                'error',
                'You cannot change your own account status.'
            );
        }

        $user->status = !$user->status;
        $user->save();

        return back()->with(
            'success',
            $user->status
                ? 'Member restrictions have been enabled.'
                : 'Member account has been activated.'
        );
    }
}