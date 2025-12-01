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
            return redirect()->route('user.dashboard')->with('error', 'You must login first.');
        }

        $category_id = $request->route('id');

        // Find a voucher for this user and category that is NOT used
        $voucher = VoucherCode::where('user_id', $user->id)
                    ->where('category_id', $category_id)
                    ->where('is_used', 0)   // Only check unused vouchers
                    ->first();

        if (!$voucher) {
            return redirect()->route('user.dashboard')
                             ->with('error', 'You do not have a valid voucher for this exam or it has already been used.');
        }

        // Optionally, you can mark it as used here if needed:
        // $voucher->update(['is_used' => 1]);

        return $next($request);
    }
}
