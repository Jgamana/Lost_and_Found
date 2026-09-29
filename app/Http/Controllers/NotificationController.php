<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(
            Notification::with('user')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'nullable|string',
            'is_read' => 'nullable|boolean',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'is_read' => $request->is_read ?? false,
        ]);

        ActivityLog::record(
            'Create Notification',
            'Created notification: "' .
            $notification->title .
            '" for user ID ' .
            $notification->user_id .
            '.'
        );

        return response()->json($notification);
    }

    public function show(string $id)
    {
        $notification = Notification::with('user')->find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        return response()->json($notification);
    }

    public function update(Request $request, string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'nullable|string',
            'is_read' => 'nullable|boolean',
        ]);

        $notification->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'is_read' => $request->is_read,
        ]);

        ActivityLog::record(
            'Update Notification',
            'Updated notification #' .
            $notification->id .
            ': "' .
            $notification->title .
            '".'
        );

        return response()->json($notification);
    }

    public function destroy(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found'
            ], 404);
        }

        ActivityLog::record(
            'Delete Notification',
            'Deleted notification #' .
            $notification->id .
            ': "' .
            $notification->title .
            '".'
        );

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ]);
    }
}