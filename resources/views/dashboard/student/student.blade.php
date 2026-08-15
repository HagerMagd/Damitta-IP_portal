@extends('layouts.dashboard.app')
@section('title')
Student Dashboard
@endsection 
@section('content')
@include('layouts.dashboard.statistics')
@include('layouts.dashboard.quick-actions')
<div class="row g-4 mb-4">

    <div class="col-lg-8">

        @include('layouts.dashboard.projects-table')

    </div>

    <div class="col-lg-4">

        @include('layouts.dashboard.notifications')

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-4">

        @include('layouts.dashboard.blockchain-card')

    </div>

    <div class="col-lg-4">

        @include('layouts.dashboard.timeline')

    </div>

    <div class="col-lg-4">

        @include('layouts.dashboard.activity')

    </div>

</div>
    
@endsection