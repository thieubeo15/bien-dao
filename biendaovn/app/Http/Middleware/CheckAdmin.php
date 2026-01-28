<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Nếu chưa đăng nhập HOẶC role không phải admin -> Chặn
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'BẠN KHÔNG CÓ QUYỀN TRUY CẬP TRANG NÀY');
        }

        return $next($request);
    }
    
}