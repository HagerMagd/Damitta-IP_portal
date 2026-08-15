<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return view('dashboard.student.notifications', compact('notifications'));
    }

    public function read($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        return redirect()->route('student.dashboard.notifications.index');
    }
    public function markAllAsRead()
    {
        Auth::user()
            ->unreadNotifications
            ->markAsRead();

        return redirect()
            ->back()
            ->with('success', 'All notifications marked as read.');
    }
}
