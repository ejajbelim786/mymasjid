<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class GlobalActivityLogger
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $this->logUserActivity($request);
        }

        return $response;
    }

    /**
     * Log activity for user actions such as login, logout, or any resource-related actions.
     */
    protected function logUserActivity(Request $request)
    {
        $user = Auth::user();
        $routeName = $request->route()->getName();
        $module = $request->segment(1); // e.g., 'products', 'users' from URL

        activity($module ?? 'global')
            ->causedBy($user)
            ->withProperties([
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'referer' => $request->headers->get('referer'),
                'route_name' => $routeName,
                'user_agent' => $request->header('User-Agent'),
                'platform' => php_uname('s'),
                'data' => $request->except(['_token', '_method']),
            ])
            ->log("User performed {$request->method()} request");
    }

    /**
     * Handle user login event logging.
     */
    public static function logLoginEvent($event)
    {
        $user = $event->user;

        activity('auth')
            ->causedBy($user)
            ->withProperties([
                'action' => 'Login',
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'platform' => php_uname('s'),
            ])
            ->log("User logged in");
    }

    /**
     * Handle user logout event logging.
     */
    public static function logLogoutEvent($event)
    {
        $user = $event->user;

        activity('auth')
            ->causedBy($user)
            ->withProperties([
                'action' => 'Logout',
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'platform' => php_uname('s'),
            ])
            ->log("User logged out");
    }
}