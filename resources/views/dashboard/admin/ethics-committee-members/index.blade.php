
@extends('layouts.admin.app')

@section('title', 'Ethics Committee Members')

@section('body')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Ethics Committee Members</h2>
            <p class="text-muted mb-0">
                Manage members assigned to ethics committees.
            </p>
        </div>

        <button class="btn btn-primary px-4"
                data-bs-toggle="modal"
                data-bs-target="#addMemberModal">
            <i class="bi bi-plus-lg me-1"></i>
            Add Ethics Member
        </button>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please check the following fields:</strong>
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
                        <p class="text-muted mb-1">Total Ethics Members</p>
                        <h3 class="fw-bold mb-0">{{ $totalMembers }}</h3>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Active Members</p>
                        <h3 class="fw-bold text-success mb-0">{{ $activeMembers }}</h3>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success">
                        <i class="bi bi-person-check fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Restricted Members</p>
                        <h3 class="fw-bold text-danger mb-0">{{ $restrictedMembers }}</h3>
                    </div>
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 text-danger">
                        <i class="bi bi-person-lock fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Members Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="fw-bold mb-0">Ethics Members Directory</h5>
        </div>

        <div class="card-body px-4">

            {{-- Search and Filter --}}
            <form method="GET"
                  action="{{ route('admin.ethics-committee-members.index') }}"
                  class="row g-2 mb-4">

                <div class="col-12 col-md-6">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name or email..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All statuses</option>
                        <option value="active"
                            {{ request('status') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="restricted"
                            {{ request('status') === 'restricted' ? 'selected' : '' }}>
                            Restricted
                        </option>
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>

                <div class="col-6 col-md-1">
                    <a href="{{ route('admin.ethics-committee-members.index') }}"
                       class="btn btn-light border w-100"
                       title="Reset filters">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Member</th>
                            <th>Ethics Committee</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($members as $member)
                            @php
                                $membership = $member->committeeMembers->first();
                                $assignedCommittee = $membership?->committee;
                            @endphp

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($member->image_path)
                                            <img src="{{ asset($member->image_path) }}"
                                                 alt="{{ $member->name }}"
                                                 class="rounded-circle"
                                                 style="width:45px;height:45px;object-fit:cover;">
                                        @else
                                            <div class="rounded-circle bg-primary bg-opacity-10
                                                        text-primary d-flex align-items-center
                                                        justify-content-center fw-bold"
                                                 style="width:45px;height:45px;">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <div class="fw-semibold">{{ $member->name }}</div>
                                            <small class="text-muted">{{ $member->email }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($assignedCommittee)
                                        <span class="fw-semibold">
                                            {{ $assignedCommittee->name }}
                                        </span>
                                        <div>
                                            <small class="text-muted">Ethics Committee</small>
                                        </div>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $member->specialization?->name ?? 'Not assigned' }}
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
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editMemberModal{{ $member->id }}"
                                                title="Edit member">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form method="POST"
                                              action="{{ route('admin.ethics-committee-members.toggle-status', $member) }}"
                                              onsubmit="return confirm('Are you sure you want to change this member status?');">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="btn btn-sm {{ $member->status ? 'btn-outline-success' : 'btn-outline-danger' }}"
                                                    title="{{ $member->status ? 'Activate member' : 'Restrict member' }}">
                                                <i class="bi {{ $member->status ? 'bi-unlock' : 'bi-lock' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-people fs-1 text-muted"></i>
                                    <h6 class="mt-3 mb-1">No ethics committee members found</h6>
                                    <p class="text-muted mb-0">
                                        Add a member or change your search filters.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                <small class="text-muted">
                    Showing {{ $members->firstItem() ?? 0 }}
                    to {{ $members->lastItem() ?? 0 }}
                    of {{ $members->total() }} members
                </small>

                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Add Member Modal --}}
<div class="modal fade" id="addMemberModal" tabindex="-1"
     aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <form method="POST"
                  action="{{ route('admin.ethics-committee-members.store') }}"
                  enctype="multipart/form-data"
                  autocomplete="off">
                @csrf

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold" id="addMemberModalLabel">
                            Add Ethics Committee Member
                        </h5>
                        <small class="text-muted">
                            Enter the member's information below.
                        </small>
                    </div>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text"
           name="name"
           class="form-control"
           autocomplete="off"
           required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                         <input type="email"
           name="email"
           class="form-control"
           autocomplete="new-email"
           readonly
           onfocus="this.removeAttribute('readonly')"
           required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                         <input type="password"
           name="password"
           class="form-control"
           autocomplete="new-password"
           readonly
           onfocus="this.removeAttribute('readonly')"
           minlength="8"
           required>
                        <small class="text-muted">At least 8 characters.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ethics Committee</label>
                        <select name="committee_id" class="form-select" required>
                            <option value="">Select an ethics committee</option>
                            @foreach($committees as $committee)
                                <option value="{{ $committee->id }}"
                                    {{ old('committee_id') == $committee->id ? 'selected' : '' }}>
                                    {{ $committee->name }}
                                    @if($committee->specialization)
                                        — {{ $committee->specialization->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if($committees->isEmpty())
                            <small class="text-danger">
                                No ethics committees are available. Create an ethics committee first.
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profile Image (Optional)</label>
                        <input type="file" name="image" class="form-control"
                               accept="image/*">
                        <small class="text-muted">
                            Maximum file size: 2 MB.
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"
                            {{ $committees->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-check-lg me-1"></i> Add Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Member Modals --}}
@foreach($members as $member)
    @php
        $currentCommitteeId = $member->committeeMembers->first()?->committee_id;
    @endphp

    <div class="modal fade" id="editMemberModal{{ $member->id }}"
         tabindex="-1"
         aria-labelledby="editMemberModalLabel{{ $member->id }}"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <form method="POST"
                      action="{{ route('admin.ethics-committee-members.update', $member) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title fw-bold"
                                id="editMemberModalLabel{{ $member->id }}">
                                Edit Ethics Committee Member
                            </h5>
                            <small class="text-muted">
                                Update {{ $member->name }}'s information.
                            </small>
                        </div>

                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $member->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ $member->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password (Optional)</label>
                            <input type="password" name="password"
                                   class="form-control" minlength="8">
                            <small class="text-muted">
                                Leave blank to keep the current password.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ethics Committee</label>
                            <select name="committee_id" class="form-select" required>
                                <option value="">Select an ethics committee</option>
                                @foreach($committees as $committee)
                                    <option value="{{ $committee->id }}"
                                        {{ $currentCommitteeId == $committee->id ? 'selected' : '' }}>
                                        {{ $committee->name }}
                                        @if($committee->specialization)
                                            — {{ $committee->specialization->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>

                            @if($member->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset($member->image_path) }}"
                                         alt="{{ $member->name }}"
                                         class="rounded"
                                         style="width:70px;height:70px;object-fit:cover;">
                                </div>
                            @endif

                            <input type="file" name="image" class="form-control"
                                   accept="image/*">
                            <small class="text-muted">
                                Leave empty to keep the current image. Maximum 2 MB.
                            </small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

@endsection
