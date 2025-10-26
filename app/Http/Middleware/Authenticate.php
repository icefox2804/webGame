<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra nếu đang truy cập admin area thì redirect về admin login
        if ($request->is('admin/*')) {
            return $request->expectsJson() ? null : route('admin.login');
        }
        
        // Ngược lại redirect về frontend login
        return $request->expectsJson() ? null : route('auth.login');
    }
}
