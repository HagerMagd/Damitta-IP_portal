@extends('layouts.dashboard.app')

@section('title', 'My Projects')

@section('content')

    <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">

        <div>

            <h2 class="page-title">My Projects</h2>

            <p class="page-subtitle">
                Manage and track all your submitted research projects.
            </p>

        </div>

        <a href="#" class="btn btn-primary submit-btn">

            <i class="fa-solid fa-plus me-2"></i>

            Submit New Project

        </a>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card stat-card">

                <div class="stat-icon blue">

                    <i class="fa-solid fa-folder-open"></i>

                </div>

                <div>

                    <h3>{{ auth()->user()->researchs()->count() }}</h3>

                    <span>Total Projects</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card stat-card">

                <div class="stat-icon orange">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <div>

                    <h3>{{ auth()->user()->researchs()->where('status', 'under_review')->count() }}</h3>

                    <span>Under Review</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card stat-card">

                <div class="stat-icon green">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div>

                    <h3>{{ auth()->user()->researchs()->where('status', 'approved')->count() }}</h3>

                    <span>Approved</span>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card stat-card">

                <div class="stat-icon red">

                    <i class="fa-solid fa-circle-xmark"></i>

                </div>

                <div>

                    <h3>{{ auth()->user()->researchs()->where('status', 'rejected')->count() }}</h3>

                    <span>Rejected</span>

                </div>

            </div>

        </div>

    </div>



    <!-- Search & Filter -->

    <div class="dashboard-card mb-4">

        <div class="row g-3 align-items-end">

            <div class="col-lg-4">

                <label class="form-label">

                    Search

                </label>

                <div class="search-box">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text" class="form-control" placeholder="Search by project title...">

                </div>

            </div>


            <div class="col-lg-2 col-md-4">

                <label class="form-label">

                    Status

                </label>

                <select class="form-select">

                    <option>All</option>

                    <option>Approved</option>

                    <option>Under Review</option>

                    <option>Pending</option>

                    <option>Rejected</option>

                </select>

            </div>


            <div class="col-lg-3 col-md-4">

                <label class="form-label">

                    Committee

                </label>

                <select class="form-select">

                    <option>All Committees</option>

                    <option>Computer Science</option>

                    <option>Engineering</option>

                    <option>Medicine</option>

                    <option>Business</option>

                </select>

            </div>


            <div class="col-lg-2 col-md-4">

                <label class="form-label">

                    Sort By

                </label>

                <select class="form-select">

                    <option>Newest</option>

                    <option>Oldest</option>

                    <option>Status</option>

                </select>

            </div>


            <div class="col-lg-1">

                <button class="btn btn-outline-secondary w-100">

                    <i class="fa-solid fa-rotate"></i>

                </button>

            </div>

        </div>

    </div>
    <!-- Projects Table -->

    <div class="dashboard-card">

        <div class="table-responsive">

            <table class="table project-table align-middle">

                <thead>

                    <tr>

                        <th>Project</th>

                        <th>Upload Date</th>

                        <th>Committee</th>

                        <th>Status</th>

                        <th>Blockchain</th>

                        <th class="text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>
                    @forelse (auth()->user()->researchs as $researchs)
                        <tr>

                            <td>

                                <div class="project-info">

                                    <div class="project-icon">

                                        <i class="fa-solid fa-file-code"></i>

                                    </div>

                                    <div>

                                        

                                        {{-- <small>{{ $researchs->title }}</small> --}}
                                        <h6>{{ $researchs->title }}</h6>

                                    </div>

                                </div>

                            </td>

                            <td>{{ $researchs->created_at->format('d M Y')}}</td>

                            <td>{{ $researchs->committee->name ?? "Null" }}</td>

                            <td>
                                @php
                                    
                            
                                    $status = [
                                        'pending' => [
                                            'class' => 'pending',
                                            'text' => 'Pending',
                                        ],

                                        'under_review' => [
                                            'class' => 'review',
                                            'text' => 'Under Review',
                                        ],

                                        'approved' => [
                                            'class' => 'approved',
                                            'text' => 'Approved',
                                        ],

                                        'rejected' => [
                                            'class' => 'rejected',
                                            'text' => 'Rejected',
                                        ],
                                    ];

                                @endphp

                            <td>

                                <span class="status {{ $status[$researchs->status]['class'] }}">

                                    {{ $status[$researchs->status]['text'] }}

                                </span>

                            </td>


                            </td>
                            @php

                                    $status = [
                                        'pending' => [
                                            'class' => 'pending',
                                            'text' => 'Pending',
                                        ],

                                        'approved' => [
                                            'class' => 'approved',
                                            'text' => 'Approved',
                                        ],

                                        'rejected' => [
                                            'class' => 'rejected',
                                            'text' => 'Rejected',
                                        ],
                                    ];

                                @endphp

                            <td>
                                  <span class="status {{ $status[$researchs->status]['class'] }}">

                                    {{ $status[$researchs->status]['text'] }}

                                </span>


                                <span class="blockchain verified">

                                    <i class="fa-solid fa-shield-check"></i>

                                    Certified

                                </span>

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a href="#" class="action-btn view">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a href="#" class="action-btn edit">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <a href="#" class="action-btn download">

                                        <i class="fa-solid fa-download"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>
                    @empty
                    <tr>      <td>

                        <span class="blockchain rejected">

                            You Have not any project yet .. 

                        </span>

                    </td></tr>
                    
                    @endforelse







                </tbody>

            </table>

        </div>



        <!-- Pagination -->

        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">

            <small class="text-muted">

                Showing 1 - 4 of 12 Projects

            </small>

            <nav>

                <ul class="pagination pagination-sm mb-0">

                    <li class="page-item disabled">

                        <a class="page-link" href="#">

                            <i class="fa-solid fa-angle-left"></i>

                        </a>

                    </li>

                    <li class="page-item active">

                        <a class="page-link" href="#">1</a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">2</a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">3</a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">

                            <i class="fa-solid fa-angle-right"></i>

                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </div>

@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.querySelector(".search-box input");
            const statusFilter = document.querySelectorAll(".form-select")[0];
            const resetBtn = document.querySelector(".btn-outline-secondary");
            const rows = document.querySelectorAll(".project-table tbody tr");

            function filterProjects() {

                const keyword = searchInput.value.toLowerCase().trim();
                const status = statusFilter.value.toLowerCase();

                rows.forEach(row => {

                    const project =
                        row.querySelector("h6").textContent.toLowerCase();

                    const rowStatus =
                        row.querySelector(".status").textContent.toLowerCase();

                    const matchProject =
                        project.includes(keyword);

                    const matchStatus =
                        status === "all" ||
                        rowStatus.includes(status);

                    if (matchProject && matchStatus) {

                        row.style.display = "";

                    } else {

                        row.style.display = "none";

                    }

                });

            }


            searchInput.addEventListener("keyup", filterProjects);

            statusFilter.addEventListener("change", filterProjects);


            resetBtn.addEventListener("click", function() {

                searchInput.value = "";

                statusFilter.selectedIndex = 0;

                rows.forEach(row => {

                    row.style.display = "";

                });

            });


            const actionButtons = document.querySelectorAll(".action-btn");

            actionButtons.forEach(btn => {

                btn.addEventListener("mouseenter", function() {

                    this.style.transform = "scale(1.08)";

                });

                btn.addEventListener("mouseleave", function() {

                    this.style.transform = "scale(1)";

                });

            });

        });
    </script>
@endpush
