<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function getnotificationByUserId($doctor_id,$viewed)
    {
        $notifications = Notification::where('doctor_id',$doctor_id)
            ->where('viewed',$viewed)
            ->get();

    }



   public function update(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->update(['viewed' => true]);
    }
}
