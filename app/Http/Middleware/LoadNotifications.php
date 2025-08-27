<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Notification;

class LoadNotifications
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        if (auth()->check()) {
            // Fetch notifications for the authenticated user
            $notifications = Notification::where('user_id', auth()->id())
                ->orWhere('doctor_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Share the notifications globally with all views
            view()->share('notifications', $notifications);
        }

        return $next($request);
    }
}
