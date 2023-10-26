<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function read(DatabaseNotification $notification): RedirectResponse
    {
        $notification->markAsRead();
        return redirect()->to($notification->data['route']);
    }

    public function allNotification()
    {
        $notifications = auth()->user()->notifications->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format("Y-m-d");
        });
        $notifications->markAsRead();

        return view('backend.notification.index', compact('notifications'));
    }
}
