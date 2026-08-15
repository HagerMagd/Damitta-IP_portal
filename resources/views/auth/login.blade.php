@extends('layouts.frontend_layouts.app')

@section('title')
Login
@endsection

@section('body')

<div class="auth-page">
    <div class="auth-container">

        <div class="auth-card">
            <h2>Welcome Back</h2>
            <p>Login to access your dashboard</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="success-msg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="remember-me">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-auth">Login</button>

                <!-- Links -->
                <div class="auth-link">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>

                <div class="auth-link">
                    <a href="{{ route('register') }}">Don't have an account? Register</a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection