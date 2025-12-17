<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VoucherCode;

class CheckVoucher
{
    /**
     * Handle an incoming request.
     */
public function handle(Request $request, Closure $next)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must login first.');
    }

    $category_id = $request->route('id');

    // Check for unused voucher
    $voucher = VoucherCode::where('user_id', $user->id)
                ->where('category_id', $category_id)
                ->where('is_used', 0)
                ->first();

    if (!$voucher) {
        return redirect()->route('user.dashboard')
                         ->with('error', 'You do not have a valid voucher for this exam or it has already been used.');
    }

    return $next($request);
}
}
