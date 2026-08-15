<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Specialization;
use App\Utlis\ImageManager;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $specializations = Specialization::all();
        return view('auth.register', compact('specializations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
      
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'specialization_id' => ['exists:specializations,id', 'required'],
            'image_path' => ['image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048', 'nullable'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => config('role.roles.default_role'),
                'specialization_id' => $request->specialization_id,
            ]);
            if ($request->hasFile('image_path')) {
                $image = ImageManager::uploadImage($request->image_path, 'users');
                $user->update([
                    'image_path' => $image,
                ]);
            }
            DB::commit();
            $user->sendEmailVerificationNotification();
            Auth::login($user);
            switch ($user->role) {
                case 'student':
         return redirect()->route('student.dashboard.home')
                        ->with('success', 'Welcome to the Damietta University Intellectual Property Community');
            }
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Please Try again !');
        }

        
    }
}
