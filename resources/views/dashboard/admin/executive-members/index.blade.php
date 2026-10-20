
@extends('layouts.admin.app')

@section('title', 'Executive Office Members')

@section('body')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Executive Office Members</h2>
            <p class="text-secondary mb-0">
                Manage executive office accounts and their access to the portal.
            </p>
        </div>

        <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addMemberModal">
            <i class="fa-solid fa-user-plus me-2"></i>
            Add Member
        </button>
    </div>

    {{-- Feedback --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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

    {{-- Statistics --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small">Total Members</div>
                        <div class="fs-3 fw-bold">{{ number_format($totalMembers) }}</div>
                    </div>
                    <i class="fa-solid fa-users fs-2 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small">Active Members</div>
                        <div class="fs-3 fw-bold text-success">
                            {{ number_format($activeMembers) }}
                        </div>
                    </div>
                    <i class="fa-solid fa-user-check fs-2 text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small">Restricted Members</div>
                        <div class="fs-3 fw-bold text-danger">
                            {{ number_format($restrictedMembers) }}
                        </div>
                    </div>
                    <i class="fa-solid fa-user-lock fs-2 text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Members Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Executive Office Directory</h5>
                    <p class="text-secondary small mb-0">
                        Search, update, and manage executive office accounts.
                    </p>
                </div>

                <span class="badge bg-light text-dark border p-2">
                    {{ $members->total() }} members
                </span>
            </div>

            {{-- Search and filters --}}
            <form method="GET"
                  action="{{ route('admin.executive-members.store') }}"
                  class="row g-2 mb-4">

                <div class="col-12 col-md-6">
                    <input type="search"
                           name="search"
                           class="form-control"
                           placeholder="Search by name or email..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All statuses</option>
                        <option value="active"
                            @selected(request('status') === 'active')>
                            Active
                        </option>
                        <option value="restricted"
                            @selected(request('status') === 'restricted')>
                            Restricted
                        </option>
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Search
                    </button>

                    <a href="{{ route('admin.executive-members.index') }}"
                       class="btn btn-light border">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Member</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($member->image_path)
                                            <img
                                                src="{{ asset($member->image_path) }}"
                                                alt="{{ $member->name }}"
                                                class="rounded-circle"
                                                style="width:45px;height:45px;object-fit:cover;">
                                        @else
                                            <div class="rounded-circle bg-primary-subtle text-primary
                                                        d-flex align-items-center justify-content-center fw-bold"
                                                 style="width:45px;height:45px;">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $member->name }}
                                            </div>
                                            <div class="text-secondary small">
                                                {{ $member->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ $member->specialization?->name ?? '—' }}
                                </td>

                                <td>
                                    @if($member->status)
                                        <span class="badge bg-danger-subtle text-danger">
                                            Restricted
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success">
                                            Active
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $member->created_at?->format('d M Y') ?? '—' }}
                                </td>

                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">

                                        {{-- Edit --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editMember{{ $member->id }}"
                                                title="Edit member">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        {{-- Activate / Restrict --}}
                                        @if($member->id !== auth()->id())
                                            <form method="POST"
                                                  action="{{ route('admin.executive-members.toggle-status', $member) }}"
                                                  onsubmit="return confirm('Are you sure you want to change this member status?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="btn btn-sm {{ $member->status ? 'btn-outline-success' : 'btn-outline-danger' }}"
                                                        title="{{ $member->status ? 'Activate member' : 'Restrict member' }}">
                                                    <i class="fa-solid {{ $member->status ? 'fa-unlock' : 'fa-ban' }}"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                            {{-- Edit Member Modal --}}
                            <div class="modal fade"
                                 id="editMember{{ $member->id }}"
                                 tabindex="-1"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="POST"
                                              action="{{ route('admin.executive-members.update', $member) }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Edit Executive Office Member</h5>
                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text"
                                                               name="name"
                                                               class="form-control"
                                                               value="{{ $member->name }}"
                                                               required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email"
                                                               name="email"
                                                               class="form-control"
                                                               value="{{ $member->email }}"
                                                               required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">New Password</label>
                                                        <input type="password"
                                                               name="password"
                                                               class="form-control"
                                                               minlength="8"
                                                               autocomplete="new-password">
                                                        <small class="text-secondary">
                                                            Leave blank to keep the current password.
                                                        </small>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Specialization</label>
                                                        <select name="specialization_id" class="form-select">
                                                            <option value="">No specialization</option>
                                                            @foreach($specializations as $specialization)
                                                                <option value="{{ $specialization->id }}"
                                                                    @selected($member->specialization_id == $specialization->id)>
                                                                    {{ $specialization->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Profile Image</label>
                                                        <input type="file"
                                                               name="image"
                                                               class="form-control"
                                                               accept="image/*">
                                                        <small class="text-secondary">
                                                            Optional. Maximum size: 2 MB.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-light border"
                                                        data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fa-solid fa-users-slash fs-2 text-secondary mb-3"></i>
                                    <h6 class="fw-bold">No Executive Office Members Found</h6>
                                    <p class="text-secondary mb-0">
                                        Try changing the search or add a new member.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                <small class="text-secondary">
                    Showing {{ $members->firstItem() ?? 0 }}
                    – {{ $members->lastItem() ?? 0 }}
                    of {{ $members->total() }} members
                </small>

                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- Add Member Modal --}}
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST"
                  action="{{ route('admin.executive-members.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Executive Office Member</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Initial Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   minlength="8"
                                   autocomplete="new-password"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Specialization</label>
                            <select name="specialization_id" class="form-select">
                                <option value="">No specialization</option>
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->id }}"
                                        @selected(old('specialization_id') == $specialization->id)>
                                        {{ $specialization->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Profile Image</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   accept="image/*">
                            <small class="text-secondary">
                                Optional. Maximum size: 2 MB.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus me-1"></i>
                        Create Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
