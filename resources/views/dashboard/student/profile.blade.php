@extends('layouts.dashboard.app')

@section('title', 'Student Profile Dashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">

            {{ session('success') }}

        </div>
    @endif
    <div class="row g-4">

        <!-- Left Side -->
        <div class="col-lg-4">

            <div class="dashboard-card profile-card text-center">

                <img src="{{ asset( 'storage/'. auth()->user()->image_path) }}" class="profile-image" alt="Profile">

                <h3 class="mt-3">{{ auth()->user()->name }}</h3>

                <span class="profile-role">{{auth()->user()->role}}</span>

                <div class="profile-details mt-4">

                    <div class="detail-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <small>Email</small>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <i class="fa-solid fa-user-tag"></i>
                        <div>
                            <small>Role</small>
                            <p>{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <div>
                            <small>Specialization</small>
                            <p>{{ auth()->user()->specialization->name }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <i class="fa-solid fa-shield-check"></i>
                        <div>
                            <small>Email Status</small>

                            @if (auth()->user()->email_verified_at)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-danger">Not Verified</span>
                            @endif

                        </div>
                    </div>

                    <div class="detail-item">
                        <i class="fa-solid fa-calendar"></i>
                        <div>
                            <small>Member Since</small>
                            <p>{{ auth()->user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                </div>

                <div class="profile-stats mt-4">

                    <div>
                        <h4>{{ auth()->user()->researchs()->count() }}</h4>
                        <span>Projects</span>
                    </div>

                    <div>
                        <h4>{{ auth()->user()->researchs()->where('status', 'approved')->count() }}</h4>
                        <span>Approved</span>
                    </div>

                    <div>
                        <h4>{{ auth()->user()->researchs()->whereHas('decision', function ($q) {
                                $q->where('result', 'approved');
                            })->count() }}
                        </h4>
                        <span>Certificates</span>
                    </div>

                </div>

                <button class="profile-btn mt-4">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Edit Profile
                </button>

            </div>

        </div>

        <!-- Right Side -->

        <div class="col-lg-8">

            <div class="dashboard-card info-card">

                <h4 class="mb-4">
                    Personal Information
                </h4>

                <form action="{{ route('student.dashboard.profile.update', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">Full Name</label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- password  --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label">New Password</label>

                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Update Your Password ">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">Confirm Password</label>

                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password">

                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">Email Address</label>

                            <input readonly type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}">

                        </div>

                        <!-- Role -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">Role</label>

                            <input type="text" class="form-control"
                                value="{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}" readonly>

                        </div>

                        <!-- Specialization -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                Specialization

                            </label>

                            <input type="text" class="form-control"
                                value="{{ ucfirst(str_replace('_', ' ', auth()->user()->Specialization->name)) }}"
                                readonly>

                        </div>

                        <!-- Image -->

                        <div class="col-12">

                            <div class="col-12 mb-4">

                                <label class="form-label">Profile Image</label>

                                <div class="image-upload">

                                    <label for="imageInput" class="image-wrapper">

                                        <img id="previewImage"
                                            src="{{ asset('storage/' . auth()->user()->image_path ?? asset('assets/images/admins/admin.jpg')) }}"
                                            class="preview-image" alt="Profile">

                                        <div class="camera-icon">

                                            <i class="fa-solid fa-camera"></i>

                                        </div>

                                    </label>

                                    <input type="file" id="imageInput" name="image_path" accept="image/*"
                                        class="form-control @error('image_path') is-invalid @enderror">
                                    @error('image_path')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">

                        <button class="profile-btn px-5">

                            <i class="fa-solid fa-floppy-disk me-2"></i>

                            Update Profile
                        </button>

                    </div>
                </form>

            </div>

        </div>

    </div>

    

@endsection
@push('js')
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (file) {

                document.getElementById('previewImage').src =
                    URL.createObjectURL(file);

            }

        });
    </script>
@endpush
