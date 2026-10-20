
@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('body')

<main class="dashboard-content">

    {{-- ==========================================
         WELCOME
    =========================================== --}}

    <section class="welcome-card">

        <div class="welcome-icon">
            <i class="fa-solid fa-building-columns"></i>
        </div>

        <h2>Welcome back, {{ $admin->name }} 👋</h2>

        <p>
            Manage intellectual property submissions, research approvals,
            university committees, and blockchain records from one secure
            platform.
        </p>

    </section>


    {{-- ==========================================
         SYSTEM OVERVIEW
    =========================================== --}}

    <div class="section-header">
        <div>
            <h5 class="section-title">System Overview</h5>
            <div class="section-subtitle">
                Current portal statistics
            </div>
        </div>

        <span class="text-muted-custom" style="font-size:10px;">
            Updated {{ now()->format('M d, Y H:i') }}
        </span>
    </div>


    <div class="row g-3">

        {{-- Total Users --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <div class="stat-label">Total Users</div>

                <div class="stat-value">
                    {{ number_format($totalUsers) }}
                </div>

                <div class="stat-change">
                    Registered portal accounts
                </div>
            </div>
        </div>


        {{-- Students --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>

                <div class="stat-label">Students</div>

                <div class="stat-value">
                    {{ number_format($studentsCount) }}
                </div>

                <div class="stat-change">
                    Student accounts
                </div>
            </div>
        </div>


        {{-- Executive --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-gold">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                </div>

                <div class="stat-label">
                    Executive Office Members
                </div>

                <div class="stat-value">
                    {{ number_format($executiveCount) }}
                </div>

                <div class="stat-change">
                    Executive accounts
                </div>
            </div>
        </div>


        {{-- Committee Members --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                </div>

                <div class="stat-label">Committee Members</div>

                <div class="stat-value">
                    {{ number_format($committeeMembersCount) }}
                </div>

                <div class="stat-change">
                    Committee accounts
                </div>
            </div>
        </div>


        {{-- Ethics Members --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-orange">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                </div>

                <div class="stat-label">Ethics Members</div>

                <div class="stat-value">
                    {{ number_format($ethicsMembersCount) }}
                </div>

                <div class="stat-change">
                    Ethics accounts
                </div>
            </div>
        </div>


        {{-- Admins --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                </div>

                <div class="stat-label">Administrators</div>

                <div class="stat-value">
                    {{ number_format($adminsCount) }}
                </div>

                <div class="stat-change">
                    Admin accounts
                </div>
            </div>
        </div>


        {{-- Total Researches --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                </div>

                <div class="stat-label">Total Researches</div>

                <div class="stat-value">
                    {{ number_format($totalResearches) }}
                </div>

                <div class="stat-change">
                    All submitted researches
                </div>
            </div>
        </div>


        {{-- Pending --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-orange">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>

                <div class="stat-label">Pending Researches</div>

                <div class="stat-value">
                    {{ number_format($pendingCount) }}
                </div>

                <div class="stat-change">
                    Awaiting review
                </div>
            </div>
        </div>


        {{-- Under Review --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-gold">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>

                <div class="stat-label">Under Review</div>

                <div class="stat-value">
                    {{ number_format($underReviewCount) }}
                </div>

                <div class="stat-change">
                    Currently being reviewed
                </div>
            </div>
        </div>


        {{-- Approved --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <div class="stat-label">Approved Researches</div>

                <div class="stat-value">
                    {{ number_format($approvedCount) }}
                </div>

                <div class="stat-change">
                    Successfully approved
                </div>
            </div>
        </div>


        {{-- Rejected --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-red">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>

                <div class="stat-label">Rejected Researches</div>

                <div class="stat-value">
                    {{ number_format($rejectedCount) }}
                </div>

                <div class="stat-change">
                    Rejected submissions
                </div>
            </div>
        </div>


        {{-- Blockchain Upload Records --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon icon-gold">
                        <i class="fa-solid fa-link"></i>
                    </div>
                </div>

                <div class="stat-label">
                    Researches with Upload Records
                </div>

                <div class="stat-value">
                    {{ number_format($verifiedResearchesCount) }}
                </div>

                <div class="stat-change">
                    Researches with upload log entries
                </div>
            </div>
        </div>

    </div>


    {{-- ==========================================
         RESEARCH TABLE + DISTRIBUTION CHART
    =========================================== --}}

    @php
        $researchDenominator = max(1, $totalResearches);

        $approvedPercentage = round(
            ($approvedCount / $researchDenominator) * 100,
            1
        );

        $underReviewPercentage = round(
            ($underReviewCount / $researchDenominator) * 100,
            1
        );

        $pendingPercentage = round(
            ($pendingCount / $researchDenominator) * 100,
            1
        );

        $rejectedPercentage = round(
            ($rejectedCount / $researchDenominator) * 100,
            1
        );
    @endphp


    <div class="row g-4 mt-1">

        {{-- Recent Research Submissions --}}
        <div class="col-xl-8">

            <div class="dashboard-card">

                <div class="card-header-custom">
                    <div>
                        <h6>Recent Research Submissions</h6>

                        <small class="text-muted-custom"
                               style="font-size:10px;">
                            Latest intellectual property submissions
                        </small>
                    </div>

                    <span class="text-muted-custom"
                          style="font-size:10px;">
                        Latest 5
                    </span>
                </div>


                <div class="table-container">

                    <table class="table custom-table">

                        <thead>
                            <tr>
                                <th>Research</th>
                                <th>Student</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Blockchain</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($researchs as $research)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $research->title }}
                                        </strong>

                                        <small class="d-block text-muted">
                                            #IP-{{ $research->id }}
                                        </small>
                                    </td>


                                    <td>
                                        {{ $research->user?->name ?? 'Unknown User' }}
                                    </td>


                                    <td>
                                        {{ $research->committee?->specialization?->name
                                            ?? 'Not Assigned' }}
                                    </td>


                                    <td>
                                        @switch($research->status)

                                            @case('approved')
                                                <span class="status-badge status-approved">
                                                    <i class="fas fa-check-circle"></i>
                                                    Approved
                                                </span>
                                                @break

                                            @case('rejected')
                                                <span class="status-badge status-rejected">
                                                    <i class="fas fa-times-circle"></i>
                                                    Rejected
                                                </span>
                                                @break

                                            @case('pending')
                                                <span class="status-badge status-review">
                                                    <i class="fas fa-clock"></i>
                                                    Pending
                                                </span>
                                                @break

                                            @case('under_review')
                                                <span class="status-badge status-review">
                                                    <i class="fas fa-clock"></i>
                                                    Under Review
                                                </span>
                                                @break

                                            @default
                                                <span class="status-badge">
                                                    {{ $research->status }}
                                                </span>

                                        @endswitch
                                    </td>


                                    <td>
                                        @if (
                                            $research->blockchain_logs
                                                ->where('type', 'upload')
                                                ->isNotEmpty()
                                        )
                                            <span class="status-badge blockchain-verified">
                                                Upload Recorded
                                            </span>
                                        @else
                                            <span class="status-badge status-review">
                                                No Upload Log
                                            </span>
                                        @endif
                                    </td>


                                    <td>
                                        <span class="text-muted">—</span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6"
                                        class="text-center py-4">
                                        No research submissions found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- Research Statistics --}}
        <div class="col-xl-4">

            <div class="dashboard-card h-100">

                <div class="card-header-custom">
                    <div>
                        <h6>Research Statistics</h6>

                        <small class="text-muted-custom"
                               style="font-size:10px;">
                            Current research distribution
                        </small>
                    </div>

                    <i class="fa-solid fa-chart-pie text-primary-custom"></i>
                </div>


                <div class="chart-placeholder">

                    <div class="donut"
                         style="
                            background: conic-gradient(
                                var(--primary) 0% {{ $approvedPercentage }}%,
                                var(--gold) {{ $approvedPercentage }}% {{ $approvedPercentage + $underReviewPercentage }}%,
                                #F97316 {{ $approvedPercentage + $underReviewPercentage }}% {{ $approvedPercentage + $underReviewPercentage + $pendingPercentage }}%,
                                #EF4444 {{ $approvedPercentage + $underReviewPercentage + $pendingPercentage }}% 100%
                            );
                         ">

                        <div class="donut-inner">
                            <strong>
                                {{ number_format($totalResearches) }}
                            </strong>

                            <small>Researches</small>
                        </div>

                    </div>

                </div>


                <div class="px-4 pb-4">

                    <div class="d-flex justify-content-between mb-3"
                         style="font-size:10px;">
                        <span>
                            <i class="fa-solid fa-circle"
                               style="color:var(--primary);font-size:7px;"></i>
                            Approved
                        </span>

                        <strong>{{ $approvedPercentage }}%</strong>
                    </div>


                    <div class="d-flex justify-content-between mb-3"
                         style="font-size:10px;">
                        <span>
                            <i class="fa-solid fa-circle"
                               style="color:var(--gold);font-size:7px;"></i>
                            Under Review
                        </span>

                        <strong>{{ $underReviewPercentage }}%</strong>
                    </div>


                    <div class="d-flex justify-content-between mb-3"
                         style="font-size:10px;">
                        <span>
                            <i class="fa-solid fa-circle"
                               style="color:#F97316;font-size:7px;"></i>
                            Pending
                        </span>

                        <strong>{{ $pendingPercentage }}%</strong>
                    </div>


                    <div class="d-flex justify-content-between"
                         style="font-size:10px;">
                        <span>
                            <i class="fa-solid fa-circle"
                               style="color:#EF4444;font-size:7px;"></i>
                            Rejected
                        </span>

                        <strong>{{ $rejectedPercentage }}%</strong>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         BLOCKCHAIN OVERVIEW
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">Blockchain Overview</h5>

            <div class="section-subtitle">
                Recorded intellectual property operations
            </div>
        </div>

    </div>


    <div class="row g-4">

        {{-- Blockchain Summary --}}
        <div class="col-xl-5">

            <div class="blockchain-card">

                <div class="row g-4">

                    <div class="col-6">
                        <div class="blockchain-label">
                            Total Transactions
                        </div>

                        <div class="blockchain-value">
                            {{ number_format($totalTransactions) }}
                        </div>
                    </div>


                    <div class="col-6 blockchain-stat">
                        <div class="blockchain-label">
                            Researches with Upload Records
                        </div>

                        <div class="blockchain-value">
                            {{ number_format($verifiedResearchesCount) }}
                        </div>
                    </div>

                </div>


                <div class="hash-box">
                    Latest Transaction Hash:

                    <br>

                    @if ($latestTransaction)

                        <code style="word-break:break-all;">
                            {{ $latestTransaction->transaction_hash }}
                        </code>

                    @else

                        <span>No blockchain transactions recorded.</span>

                    @endif
                </div>


                <div class="row mt-4">

                    <div class="col-6">
                        <div class="blockchain-label">
                            Latest Operation
                        </div>

                        <strong>
                            {{ $latestTransaction
                                ? ucfirst($latestTransaction->type)
                                : 'No operations' }}
                        </strong>
                    </div>


                    <div class="col-6">
                        <div class="blockchain-label">
                            Database Records
                        </div>

                        <strong>
                            {{ number_format($totalTransactions) }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Latest Blockchain Records --}}
        <div class="col-xl-7">

            <div class="dashboard-card">

                <div class="card-header-custom">
                    <div>
                        <h6>Latest Blockchain Records</h6>

                        <small class="text-muted-custom"
                               style="font-size:10px;">
                            Recently recorded operations
                        </small>
                    </div>
                </div>


                <div class="table-container">

                    <table class="table custom-table">

                        <thead>
                            <tr>
                                <th>Research</th>
                                <th>Transaction Hash</th>
                                <th>Block</th>
                                <th>Timestamp</th>
                                <th>Operation</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse ($blockchainLogs as $log)

                                <tr>

                                    <td>
                                        {{ $log->research?->title
                                            ?? 'Research unavailable' }}
                                    </td>


                                    <td>
                                        <code title="{{ $log->transaction_hash }}">
                                            {{ \Illuminate\Support\Str::limit(
                                                $log->transaction_hash,
                                                18
                                            ) }}
                                        </code>
                                    </td>


                                    <td>
                                        <span class="text-muted">
                                            Not stored
                                        </span>
                                    </td>


                                    <td>
                                        {{ $log->created_at?->format('M d, Y H:i') }}
                                    </td>


                                    <td>
                                        <span class="status-badge">
                                            {{ ucfirst($log->type) }} recorded
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5"
                                        class="text-center py-4">
                                        No blockchain logs found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         USER MANAGEMENT
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">User Management</h5>

            <div class="section-subtitle">
                Manage portal users and permissions
            </div>
        </div>

    </div>


    <div class="dashboard-card">

        <div class="card-header-custom">

            <form method="GET"
                  action="{{ route('admin.dashboard.home') }}"
                  class="d-flex flex-wrap gap-2 align-items-center">

                <input type="hidden"
                       name="year"
                       value="{{ $year }}">

                <div style="position:relative;">

                    <i class="fa-solid fa-magnifying-glass"
                       style="
                            position:absolute;
                            left:11px;
                            top:11px;
                            color:#94A3B8;
                            font-size:10px;
                       "></i>

                    <input
                        class="filter-input"
                        style="padding-left:30px;"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search users..."
                    >

                </div>


                <select class="filter-select" name="role">

                    <option value="">All Roles</option>

                    <option value="admin"
                        @selected($role === 'admin')>
                        Admin
                    </option>

                    <option value="student"
                        @selected($role === 'student')>
                        Student
                    </option>

                    <option value="executive"
                        @selected($role === 'executive')>
                        Executive
                    </option>

                    <option value="committee_member"
                        @selected($role === 'committee_member')>
                        Committee
                    </option>

                    <option value="ethics_member"
                        @selected($role === 'ethics_member')>
                        Ethics
                    </option>

                </select>


                <button type="submit" class="primary-btn">
                    <i class="fa-solid fa-filter me-1"></i>
                    Filter
                </button>


                <a href="{{ route('admin.dashboard.home', ['year' => $year]) }}"
                   class="primary-btn">
                    Clear
                </a>

            </form>

        </div>


        <div class="table-container">

            <table class="table custom-table">

                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Email Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse ($users as $user)

                        <tr>

                            <td>

                                <div class="user-cell">

                                    <div class="table-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr($user->name, 0, 2)
                                        ) }}

                                    </div>

                                    <div>
                                        <strong>{{ $user->name }}</strong>

                                        <small>
                                            #USR-{{ $user->id }}
                                        </small>
                                    </div>

                                </div>

                            </td>


                            <td>{{ $user->email }}</td>


                            <td>
                                <span class="role-badge">

                                    {{ ucfirst(
                                        str_replace('_', ' ', $user->role)
                                    ) }}

                                </span>
                            </td>


                            <td>
                                {{ $user->specialization?->name
                                    ?? 'Not Assigned' }}
                            </td>


                            <td>

                                @if ($user->email_verified_at)

                                    <span class="status-badge status-active">
                                        Verified
                                    </span>

                                @else

                                    <span class="status-badge status-inactive">
                                        Unverified
                                    </span>

                                @endif

                            </td>


                            <td>
                                {{ $user->created_at?->format('M d, Y') }}
                            </td>


                            <td>
                                <span class="text-muted">—</span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="text-center py-4">
                                No users match your search.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="pagination-wrapper">

            <div class="pagination-info">

                Showing {{ $users->firstItem() ?? 0 }}
                –
                {{ $users->lastItem() ?? 0 }}
                of {{ $users->total() }} users

            </div>

            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>

    </div>


    {{-- ==========================================
         REPORTS & STATISTICS
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">Reports & Statistics</h5>

            <div class="section-subtitle">
                Monitor portal activity and research trends
            </div>
        </div>


        <a href="{{ route('admin.dashboard.export') }}"
           class="primary-btn">

            <i class="fa-solid fa-download me-1"></i>
            Export Report

        </a>

    </div>


    <div class="row g-4">

        {{-- Monthly Submissions --}}
        <div class="col-xl-8">

            <div class="dashboard-card">

                <div class="card-header-custom">

                    <div>
                        <h6>Monthly Submissions</h6>

                        <small class="text-muted-custom">
                            Research submissions during {{ $year }}
                        </small>
                    </div>


                    <form method="GET"
                          action="{{ route('admin.dashboard.home') }}">

                        <input type="hidden"
                               name="search"
                               value="{{ $search }}">

                        <input type="hidden"
                               name="role"
                               value="{{ $role }}">

                        <select
                            class="filter-select"
                            name="year"
                            onchange="this.form.submit()"
                        >

                            @for ($y = now()->year; $y >= 2020; $y--)

                                <option value="{{ $y }}"
                                    @selected($year === $y)>
                                    {{ $y }}
                                </option>

                            @endfor

                        </select>

                    </form>

                </div>


                <div class="chart-placeholder">

                    <div class="fake-chart">

                        <div class="chart-grid"></div>

                        <div class="bar-chart">

                            @foreach ($monthlySubmissions as $monthData)

                                @php
                                    $height = $monthData['total'] > 0
                                        ? max(
                                            5,
                                            (
                                                $monthData['total']
                                                / $maxMonthlySubmissions
                                            ) * 100
                                        )
                                        : 0;
                                @endphp

                                <div
                                    class="bar"
                                    style="height:{{ $height }}%;"
                                    title="{{ $monthData['total'] }} researches"
                                ></div>

                            @endforeach

                        </div>

                    </div>

                </div>


                <div class="px-4 pb-3">

                    <div class="d-flex justify-content-between"
                         style="font-size:9px;color:#94A3B8;">

                        @foreach (
                            [
                                'Jan', 'Feb', 'Mar', 'Apr',
                                'May', 'Jun', 'Jul', 'Aug',
                                'Sep', 'Oct', 'Nov', 'Dec'
                            ] as $month
                        )

                            <span>{{ $month }}</span>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        {{-- Approval Rate --}}
        <div class="col-xl-4">

            <div class="dashboard-card h-100">

                <div class="card-header-custom">

                    <div>
                        <h6>Approval Rate</h6>

                        <small class="text-muted-custom">
                            Research decision overview
                        </small>
                    </div>

                </div>


                <div class="chart-placeholder">

                    <div class="donut"
                         style="
                            background: conic-gradient(
                                var(--primary) 0% {{ $approvalRate }}%,
                                #E5E7EB {{ $approvalRate }}% 100%
                            );
                         ">

                        <div class="donut-inner">

                            <strong>{{ $approvalRate }}%</strong>

                            <small>Approved</small>

                        </div>

                    </div>

                </div>


                <div class="px-4 pb-4">

                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-size:10px;">Approved</span>

                        <strong style="font-size:10px;">
                            {{ $approvedCount }}
                        </strong>
                    </div>


                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-size:10px;">Pending</span>

                        <strong style="font-size:10px;">
                            {{ $pendingCount }}
                        </strong>
                    </div>


                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-size:10px;">Under Review</span>

                        <strong style="font-size:10px;">
                            {{ $underReviewCount }}
                        </strong>
                    </div>


                    <div class="d-flex justify-content-between">
                        <span style="font-size:10px;">Rejected</span>

                        <strong style="font-size:10px;">
                            {{ $rejectedCount }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         RECENT ACTIVITY
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">Recent Activity</h5>

            <div class="section-subtitle">
                Latest research and blockchain records
            </div>
        </div>

    </div>


    <div class="dashboard-card">

        @forelse ($recentActivities as $activity)

            <div class="notification-item">

                <div class="notification-icon {{ $activity['color'] }}">

                    <i class="fa-solid {{ $activity['icon'] }}"></i>

                </div>


                <div class="notification-text">

                    <strong>{{ $activity['title'] }}</strong>

                    <p>{{ $activity['description'] }}</p>

                    <small>
                        {{ $activity['created_at']?->diffForHumans() }}
                    </small>

                </div>

            </div>

        @empty

            <div class="empty-state">

                <div class="empty-state-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <h6>No recent activity</h6>

                <p>
                    There are no research or blockchain records yet.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ==========================================
         SYSTEM SETTINGS
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">System Settings</h5>

            <div class="section-subtitle">
                Configuration areas for the portal
            </div>
        </div>

    </div>


    <div class="row g-3">

        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-sliders"></i>
                </div>

                <h6>General Settings</h6>

                <p>
                    Portal name, university information and system preferences.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Configuration page not connected
                </span>

            </div>
        </div>


        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <h6>Email Settings</h6>

                <p>
                    Email services, notifications and automated messages.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Configuration page not connected
                </span>

            </div>
        </div>


        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <h6>Security</h6>

                <p>
                    Authentication, roles, permissions and security policies.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Configuration page not connected
                </span>

            </div>
        </div>


        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-database"></i>
                </div>

                <h6>System Backup</h6>

                <p>
                    Database backup and system recovery management.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Backup functionality not connected
                </span>

            </div>
        </div>


        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-link"></i>
                </div>

                <h6>Blockchain Configuration</h6>

                <p>
                    Blockchain nodes and verification configuration.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Blockchain integration not connected
                </span>

            </div>
        </div>


        <div class="col-md-6 col-xl-4">
            <div class="settings-card">

                <div class="settings-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>

                <h6>Activity Logs</h6>

                <p>
                    Review administrative and system activities.
                </p>

                <span class="text-muted-custom"
                      style="font-size:10px;">
                    Activity details shown above
                </span>

            </div>
        </div>

    </div>


    {{-- ==========================================
         ADMINISTRATOR PROFILE
    =========================================== --}}

    <div class="section-header">

        <div>
            <h5 class="section-title">Administrator Profile</h5>

            <div class="section-subtitle">
                Current account information
            </div>
        </div>

    </div>


    <div class="row g-4">

        <div class="col-xl-5">

            <div class="dashboard-card">

                <div class="profile-cover">

                    <div class="profile-large-avatar">

                        {{ mb_strtoupper(
                            mb_substr($admin->name, 0, 2)
                        ) }}

                    </div>

                </div>


                <div class="profile-content">

                    <h5>{{ $admin->name }}</h5>

                    <small>
                        {{ ucfirst(
                            str_replace('_', ' ', $admin->role)
                        ) }}
                    </small>


                    <div class="mt-4">

                        <div class="profile-info-row">
                            <span>Email</span>
                            <span>{{ $admin->email }}</span>
                        </div>


                        <div class="profile-info-row">
                            <span>Role</span>

                            <span>
                                {{ ucfirst(
                                    str_replace('_', ' ', $admin->role)
                                ) }}
                            </span>
                        </div>


                        <div class="profile-info-row">
                            <span>Department</span>

                            <span>
                                {{ $admin->specialization?->name
                                    ?? 'Not Assigned' }}
                            </span>
                        </div>


                        <div class="profile-info-row">
                            <span>Account Created</span>

                            <span>
                                {{ $admin->created_at?->format('M d, Y') }}
                            </span>
                        </div>


                        <div class="profile-info-row">
                            <span>Email Verification</span>

                            <span class="{{ $admin->email_verified_at
                                ? 'text-success'
                                : 'text-danger' }}">

                                {{ $admin->email_verified_at
                                    ? 'Verified'
                                    : 'Unverified' }}

                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-7">

            <div class="dashboard-card">

                <div class="card-header-custom">

                    <h6>Account Information</h6>

                </div>


                <div class="card-body-custom">

                    <div class="mb-3">

                        <label class="form-label">Full Name</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $admin->name }}"
                            readonly
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">Email Address</label>

                        <input
                            type="email"
                            class="form-control"
                            value="{{ $admin->email }}"
                            readonly
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">Role</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ ucfirst(
                                str_replace('_', ' ', $admin->role)
                            ) }}"
                            readonly
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">Specialization</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $admin->specialization?->name
                                ?? 'Not Assigned' }}"
                            readonly
                        >

                    </div>


                    <small class="text-muted-custom">
                        Profile editing is not connected to a save endpoint yet.
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
         FOOTER
    =========================================== --}}

    <footer class="text-center py-4 mt-3">

        <small style="font-size:10px;color:#94A3B8;">

            © {{ now()->year }} Damietta IP Portal ·
            Intellectual Property Management System

        </small>

    </footer>


</main>

@endsection
