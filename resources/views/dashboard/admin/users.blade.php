
@extends('layouts.admin.app')

@section('title', 'User Management')

@section('body')


<div class="users-page">

    {{-- Page Header --}}
    <div class="users-header">
        <div>
            <h2>User Management</h2>
            <p>
                Manage portal accounts and control access to system features.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-primary border p-2">
                <i class="fa-solid fa-shield-halved me-1"></i>
                Administrator
            </span>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Users</div>
                        <div class="stat-number">
                            {{ number_format($totalUsers) }}
                        </div>
                    </div>

                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Active Accounts</div>
                        <div class="stat-number text-success">
                            {{ number_format($activeUsers) }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background:#e8f8ef;color:#16834a">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Restricted Accounts</div>
                        <div class="stat-number text-danger">
                            {{ number_format($blockedUsers) }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background:#fff0f0;color:#c53030">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Main Table --}}
    <div class="users-panel">

        <div class="panel-header">

            <div class="d-flex justify-content-between align-items-start
                        flex-wrap gap-3 mb-4">

                <div>
                    <h5>
                        <i class="fa-solid fa-users me-2 text-primary"></i>
                        Portal Users
                    </h5>

                    <p>
                        Search accounts, filter by role, and manage restrictions.
                    </p>
                </div>

                <span class="badge bg-light text-secondary border p-2">
                    {{ $users->total() }} users
                </span>

            </div>

            {{-- Filters --}}
            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="d-flex flex-wrap gap-2">

                <div class="input-group search-box">
                    <span class="input-group-text bg-white">
                        <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </span>

                    <input type="search"
                           name="search"
                           class="form-control filter-control"
                           placeholder="Search by name or email..."
                           value="{{ request('search') }}">
                </div>

                <select name="role" class="form-select filter-control"
                        style="max-width:210px">
                    <option value="">All Roles</option>

                    <option value="student"
                        @selected(request('role') === 'student')>
                        Student
                    </option>

                    <option value="committee_member"
                        @selected(request('role') === 'committee_member')>
                        Committee Member
                    </option>

                    <option value="ethics_member"
                        @selected(request('role') === 'ethics_member')>
                        Ethics Member
                    </option>

                    <option value="executive"
                        @selected(request('role') === 'executive')>
                        Executive Office
                    </option>

                    <option value="admin"
                        @selected(request('role') === 'admin')>
                        Admin
                    </option>
                </select>

                <select name="status" class="form-select filter-control"
                        style="max-width:170px">
                    <option value="">All Statuses</option>

                    <option value="active"
                        @selected(request('status') === 'active')>
                        Active
                    </option>

                    <option value="blocked"
                        @selected(request('status') === 'blocked')>
                        Restricted
                    </option>
                </select>

                <button type="submit" class="btn btn-primary px-3">
                    <i class="fa-solid fa-filter me-1"></i>
                    Apply
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-light border px-3">
                    Reset
                </a>

            </form>
        </div>

        <div class="table-responsive">

            <table class="table users-table">

                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Specialization</th>
                        <th>Account Status</th>
                        <th>Registration Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- User --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">

                                    <div class="user-avatar">
                                        @if($user->image_path)
                                            <img
                                                src="{{ asset('storage/' . $user->image_path) }}"
                                                alt="{{ $user->name }}">
                                        @else
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        @endif
                                    </div>

                                    <div>
                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-email">
                                            {{ $user->email }}
                                        </div>
                                    </div>

                                </div>
                            </td>

                            {{-- Role --}}
                            <td>
                                <span class="role-badge">
                                    {{ ucwords(str_replace(
                                        '_',
                                        ' ',
                                        $user->role
                                    )) }}
                                </span>
                            </td>

                            {{-- Specialization --}}
                            <td>
                                {{ $user->specialization?->name ?? '—' }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($user->status =='false')
                                    <span class="status-badge status-blocked">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Restricted
                                    </span>
                                @else
                                    <span class="status-badge status-active">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Active
                                    </span>
                                @endif
                            </td>

                            {{-- Registration Date --}}
                            <td>
                                {{ $user->created_at?->format('d M Y') ?? '—' }}
                            </td>

                            {{-- Action --}}
                            <td class="text-end">

                                @if($user->id === auth()->id())

                                    <button type="button"
                                            class="btn btn-light border action-btn"
                                            disabled>
                                        <i class="fa-solid fa-user-shield me-1"></i>
                                        Your Account
                                    </button>

                                @else

                                  
<form action="{{ route('admin.users.toggle-block', $user) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('{{ $user->status=='false'
          ? 'Are you sure you want to remove restrictions from this user?'
          : 'Are you sure you want to restrict this user?' }}')">
    @csrf
    @method('PATCH')

    <button type="submit"
            class="btn btn-sm {{ $user->status=='false' ? 'btn-success' : 'btn-outline-danger' }}"
            title="{{ $user->status=='false' ? 'Remove restrictions' : 'Restrict user' }}"
            aria-label="{{ $user->status=='false' ? 'Remove restrictions' : 'Restrict user' }}">

        @if($user->status=='false')
            <i class="fa-solid fa-lock-open"></i>
        @else
            <i class="fa-solid fa-ban"></i>
        @endif

    </button>
</form>


                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fa-solid fa-users-slash d-block"></i>
                                    <h6 class="fw-bold text-dark">
                                        No Users Found
                                    </h6>
                                    <p class="mb-0">
                                        Try another search term or change the filters.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="panel-footer">

            <small>
                Showing {{ $users->firstItem() ?? 0 }}
                – {{ $users->lastItem() ?? 0 }}
                of {{ $users->total() }} users
            </small>

           {{ $users->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection
