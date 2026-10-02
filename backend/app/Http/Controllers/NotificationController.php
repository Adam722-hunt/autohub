<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications();

        if ($request->unread) {
            $notifications->whereNull('read_at');
        }
        $unreadCount = $request->user()->notifications()
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'notifications' => $notifications->latest()->get(),
            'unread_count' => $unreadCount
        ], 200);
    }

    public function markAsRead(Request $request, $notification)
    {
        $notification = $request->user()->notifications()->where('id', $notification)->first();

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'message' => 'Notification marked as read'
        ], 200);
    }

    public function deleteNotification(Request $request, $notification)
    {
        $notification = $request->user()
            ->notifications()
            ->where('id', $notification)
            ->first();

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ], 200);
    }
}
