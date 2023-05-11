<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Models\User_Notification;
use App\Models\UserUser;

class NotificationController extends Controller
{
    public function Store(Request $request)
    {

        $validated = $request->validate([
            'notification' => 'required',
        ]);
        $user = auth()->user();
        $user_id = $user->id;
       $emergency_users = UserUser::where('user_id', $user_id)->get();
        $notification = Notification::create([
            'notification' => $validated['notification'],
        ]);
        foreach($emergency_users as $emergency_user){
            User_Notification::create([
                'user_id' => $user->id,
                'notification_id' => $notification->id,
                'emergency_contact_id'=> $emergency_user->emergency_contact_id,
            ]);
        }
        return response()->json([
            'message' => 'Notification created',
            'data' => $notification,
        ]);
    }

    public function Show()
    {
        $user = auth()->user()->id;
        $notifications = User_Notification::where('emergency_contact_id', $user)->get();

        $notificationIds = [];
        foreach ($notifications as $notification) {
            $notificationIds[] = $notification->notification_id;
        }

        $notification = Notification::whereIn('id', $notificationIds)->get();

        return response()->json([
            'message' => 'Notification shown',
            'data' => $notification,
        ]);
    }

    public function delete(Request $request){
        $user = auth()->user()->id;
        $notifications = User_Notification::where('emergency_contact_id', $user)->get();
        $notificationIds = [];
        foreach ($notifications as $notification) {
            $notificationIds[] = $notification->notification_id;
        }

        $notification = Notification::whereIn('id', $notificationIds)->get();

              // Remove the relationship between the user and the notification
    User_Notification::where('emergency_contact_id', $user)->delete();

    // Check if the notification has any more relationships
    $remainingRelationships = User_Notification::whereIn('notification_id', $notificationIds)->count();

    if ($remainingRelationships == 0) {
        // If there are no more relationships, delete the notification from the notifications table
        Notification::whereIn('id', $notificationIds)->delete();
    }

    return response()->json([
        'message' => 'Notification shown and removed',
        'data' => $notification,
    ]);

    }

}
