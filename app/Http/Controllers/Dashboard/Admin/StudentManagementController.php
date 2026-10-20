<?php
namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class StudentManagementController extends Controller
{
    public function index()
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $specializations = specialization::orderBy('name')->get();

        $students = User::with('specialization')
            ->where('role', 'student')
            ->latest()
            ->paginate(10);

        return view('dashboard.admin.student', compact(
            'specializations',
            'students'
        ));
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'specialization_id' => [
                'required',
                'exists:specializations,id',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        DB::transaction(function () use ($validated) {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'specialization_id' => $validated['specialization_id'],
                'password' => $validated['password'],
                'role' => 'student',
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student account created successfully.');
    }
}
