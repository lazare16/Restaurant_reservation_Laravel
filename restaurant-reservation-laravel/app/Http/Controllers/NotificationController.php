<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_read' => 'boolean',
        ]);

        $notification = Notification::create($data);
        return response()->json($notification, 201);
    }

    public function show(Notification $notification)
    {
        return $notification;
    }

    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'message' => 'string',
            'is_read' => 'boolean',
        ]);

        $notification->update($data);
        return response()->json($notification, 200);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }

    public function markAsRead(Notification $notification)
{
    $notification->update(['is_read' => true]);
    return redirect()->route('notifications.index')->with('success', 'Notification marked as read.');
}
}
