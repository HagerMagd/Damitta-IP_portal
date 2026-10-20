<?php
namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $query = User::with('specialization');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->status === 'false') {
            $query->where('status', true);
        } elseif ($request->status === 'active') {
            $query->where('status', false);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        $totalUsers = User::count();
        $activeUsers = User::where('status', false)->count();
        $blockedUsers = User::where('status', true)->count();

        return view('dashboard.admin.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'blockedUsers'
        ));
    }

    
public function toggleBlock(User $user)
{
    abort_unless(Auth::user()?->role === 'admin', 403);

    if ($user->id === Auth::id()) {
        return back()->with(
            'error',
            'You cannot change your own account status.'
        );
    }

    $user->status = ! $user->status;
    $user->save();

    return back()->with(
        'success',
        $user->status
            ? 'User restrictions have been enabled successfully.'
            : 'User restrictions have been removed successfully.'
    );
}

}
