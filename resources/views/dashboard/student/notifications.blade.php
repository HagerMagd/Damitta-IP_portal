@extends('layouts.dashboard.app')

@section('title')
    Notifications
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Notifications</h2>
        <p class="text-muted mb-0">
            Stay updated with your research status.
        </p>
    </div>

    @if(auth()->user()->unreadNotifications->count())
        <form action="{{ route('student.dashboard.notifications.readAll') }}" method="POST">
            @csrf

            <button class="btn btn-primary">
                Mark All as Read
            </button>
        </form>
    @endif

</div>
    <div class="notifications">

   @forelse($notifications as $notification)

<a href="{{ route('student.dashboard.notifications.read',$notification->id) }}"
   class="notification-card {{ $notification->read_at ? 'read' : 'unread' }}">

    <div class="d-flex justify-content-between">
        <h6>{{ $notification->data['title'] }}</h6>

        <small>
            {{ $notification->created_at->diffForHumans() }}
        </small>
    </div>

    <p>
        {{ $notification->data['message'] }}
    </p>

</a>

@empty

<div class="empty-notification text-center">
    <i class="fas fa-bell-slash fa-4x"></i>

    <h5>No Notifications Yet</h5>

    <p>
        You'll receive notifications whenever your research status changes.
    </p>
</div>

@endforelse

</div>
@endsection

  
