<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'Semua notifikasi ditandai sebagai dibaca.');
    }
}
