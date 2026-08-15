@extends('layouts.frontend_layouts.app')

@section('title')
    Register
@endsection

@section('body')

    <div class="auth-page">
        <div class="auth-container">

            <div class="auth-card">
                <h2>Create Your Account</h2>
                <p>Register as a student </p>

                @if (session()->has('errors'))
                    <div class="alert alert-warning" role="alert">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <h4>Basic Information</h4>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </div>

                    @error('name')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror

                    <h4>Account Details</h4>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    @error('password')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" required>
                    </div>

                    <h4>Profile</h4>

                  

                    @error('role')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror

                    <div class="form-group">
                        <label>Specialization</label>
                        <select name="specialization_id">
                            <option value="" selected disabled>Select specialization</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}">
                                    {{ $specialization->name }}
                                </option>
                            @endforeach


                        </select>
                    </div>
                    @error('specialization_id')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror

                    <div class="form-group">
                        <label>Upload Image</label>

                        <input type="file" name="image_path" id="imageInput" >

                       
                    </div>
                    @error('image_path')
                        <small class="text-danger">

                            {{ $message }}

                        </small>
                    @enderror
                    

                    <button type="submit" class="btn-auth">Register</button>
                </form>
            </div>

        </div>
    </div>

@endsection
@push('js')
<script>
$(function() {

    $('#imageInput').fileinput({
        theme: 'fa5',
        allowedFileTypes: ['image'],
        showUpload: false,
        enableResumableUpload: false,
        maxFileCount: 5,
        showCancel: true
    });

});
</script>
@endpush