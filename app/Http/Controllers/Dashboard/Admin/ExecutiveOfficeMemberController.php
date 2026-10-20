<?php
namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\specialization;
use App\Utlis\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ExecutiveOfficeMemberController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403);
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $query = User::with('specialization')
            ->where('role', 'executive');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->status === 'active') {
            $query->where('status', false);
        } elseif ($request->status === 'restricted') {
            $query->where('status', true);
        }

        $members = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $totalMembers = User::where('role', 'executive')->count();

        $activeMembers = User::where('role', 'executive')
            ->where('status', false)
            ->count();

        $restrictedMembers = User::where('role', 'executive')
            ->where('status', true)
            ->count();

        $specializations = specialization::orderBy('name')->get();

        return view(
            'dashboard.admin.executive-members.index',
            compact(
                'members',
                'totalMembers',
                'activeMembers',
                'restrictedMembers',
                'specializations'
            )
        );
    }

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
            'password' => ['required', 'string', 'min:8'],
            'specialization_id' => [
                'nullable',
                'exists:specializations,id',
            ],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $member = new User();

        $member->name = $validated['name'];
        $member->email = $validated['email'];
        $member->password = Hash::make($validated['password']);
        $member->role = 'executive';
        $member->status = true;
        $member->specialization_id =
            $validated['specialization_id'] ?? null;

        if ($request->hasFile('image')) {
            $member->image_path = ImageManager::uploadImage(
                $request->file('image'),
                'executive-members'
            );
        }

        $member->save();

        return redirect()
            ->route('admin.executive-members.index')
            ->with(
                'success',
                'Executive Office member added successfully.'
            );
    }

    public function update(Request $request, User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'executive', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'specialization_id' => [
                'nullable',
                'exists:specializations,id',
            ],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->specialization_id =
            $validated['specialization_id'] ?? null;

        // تحديث كلمة المرور فقط لو اتدخلت كلمة مرور جديدة.
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // لو فيه صورة جديدة، نحذف القديمة ونحفظ الجديدة.
        if ($request->hasFile('image')) {
            if ($user->image_path) {
                ImageManager::deleteimage($user->image_path);
            }

            $user->image_path = ImageManager::uploadImage(
                $request->file('image'),
                'executive-members'
            );
        }

        $user->save();

        return redirect()
            ->route('admin.executive-members.index')
            ->with(
                'success',
                'Executive Office member updated successfully.'
            );
    }

    public function toggleStatus(User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'executive', 404);

        if ($user->id === Auth::id()) {
            return back()->with(
                'error',
                'You cannot change your own account status.'
            );
        }

        // false = active, true = restricted.
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
