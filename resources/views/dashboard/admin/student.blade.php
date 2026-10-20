
@extends('layouts.admin.app')

@section('title', 'Student Management')

@section('body')
<div class="students-page">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <h3 class="page-title mb-1">Student Management</h3>
            <p class="text-muted mb-0">
                Create and manage student accounts.
            </p>
        </div>

        <span class="student-count">
            {{ $students->total() }} Students
        </span>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Student Form --}}
    <div class="custom-card p-4 mb-4">

        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 p-3"
                 style="background:#e8f1fa;color:#0F4C81;">
                <i class="fa-solid fa-user-plus fa-lg"></i>
            </div>

            <div>
                <h5 class="mb-1 fw-bold">Add New Student</h5>
                <p class="text-muted small mb-0">
                    Enter the student's information below.
                </p>
            </div>
        </div>

        <form action="{{ route('admin.students.store') }}"
              method="POST">

            @csrf

            <div class="row g-3">

                {{-- Full Name --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">
                        Full Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Enter student's full name"
                           required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label for="email" class="form-label">
                        Email Address <span class="text-danger">*</span>
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="student@example.com"
                           required>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Specialization --}}
                <div class="col-md-6">
                    <label for="specialization_id" class="form-label">
                        Academic Specialization
                        <span class="text-danger">*</span>
                    </label>

                    <select id="specialization_id"
                            name="specialization_id"
                            class="form-select @error('specialization_id') is-invalid @enderror"
                            required>

                        <option value="">Select specialization</option>

                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}"
                                @selected(old('specialization_id') == $specialization->id)>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('specialization_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="col-md-6">
                    <label for="password" class="form-label">
                        Password <span class="text-danger">*</span>
                    </label>

                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimum 8 characters"
                           autocomplete="new-password"
                           required>

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">
                        Confirm Password
                        <span class="text-danger">*</span>
                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Re-enter password"
                           autocomplete="new-password"
                           required>
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-user-plus me-2"></i>
                    Create Student Account
                </button>
            </div>

        </form>
    </div>

    {{-- Students List --}}
    <div class="custom-card overflow-hidden">

        <div class="p-4 border-bottom">
            <h5 class="fw-bold mb-1">Registered Students</h5>
            <p class="text-muted small mb-0">
                Students registered in the system.
            </p>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">

                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Registered At</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="student-avatar">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </span>

                                    <span class="fw-semibold">
                                        {{ $student->name }}
                                    </span>
                                </div>
                            </td>

                            <td>{{ $student->email }}</td>

                            <td>
                                {{ $student->specialization?->name ?? 'Not assigned' }}
                            </td>

                            <td>
                                {{ $student->created_at?->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fa-solid fa-user-graduate fa-2x
                                          text-muted mb-3"></i>

                                <p class="fw-semibold mb-1">
                                    No students found
                                </p>

                                <p class="text-muted small mb-0">
                                    Add your first student using the form above.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @if($students->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>

@endsection
