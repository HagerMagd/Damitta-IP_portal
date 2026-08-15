<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\student\UpdateStudentProfileRequest;
use App\Models\specialization;
use App\Models\User;
use App\Utlis\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $specializations = specialization::all();
        return view('dashboard.student.profile', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentProfileRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->safe()->except('_token', '_method', 'image_path');

        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = Hash::make($data['password']);
        }
      
        if ($request->hasFile('image_path')) {
            ImageManager::deleteimage($user->image_path);
            $path = ImageManager::uploadImage($request->image_path, 'users');
            $user->update([
                'image_path' => $path,
            ]);
            
        }
        $user->update($data);
        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');


        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
