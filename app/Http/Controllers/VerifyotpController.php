<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerifyotpController extends Controller
{
    
     public function verifyaccount()
    {
        return view('auth.verifyotp'); // your OTP Blade form
    }



public function verifyotp(Request $request)
{
    $request->validate(['token' => 'required|numeric']);

    $email = session('otp_email'); // get the new user email

    if (!$email) {
        return redirect()->route('login')->with('error', 'Session expired. Please login again.');
    }

    $token_record = Verifytoken::where('email', $email)
                               ->where('token', $request->token)
                               ->first();

    if (!$token_record || ($token_record->expires_at && $token_record->expires_at < now())) {
        return back()->with('error', 'Invalid or expired OTP.');
    }

    // ✅ Activate user
    $user = User::where('email', $email)->first();
    $user->is_active = 1;
    $user->save();

    // ✅ Delete OTP record
    $token_record->delete();

    // ✅ Log in the user automatically
    Auth::login($user);

    // ✅ Clear session
    session()->forget('otp_email');

    // ✅ Redirect new user to dashboard
    return redirect()->route('user.dashboard')->with('success', 'Account verified and logged in!');
}

public function resend()
{
    // Use the same session key as verifyotp
    $email = session('otp_email');

    if (!$email) {
        return response()->json([
            'message' => 'Session expired. Please login again.'
        ], 400);
    }

    $user = User::where('email', $email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    // Generate new OTP
    $otp = rand(100000, 999999);

    // Save OTP to database or Verifytoken table (depending on your flow)
    // Here assuming you have a Verifytoken table
    \App\Models\Verifytoken::updateOrCreate(
        ['email' => $user->email],
        ['token' => $otp, 'expires_at' => now()->addMinutes(5)]
    );

    // Send OTP email
    Mail::raw("Your OTP code is: $otp", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Resent OTP Code');
    });

    return response()->json([
        'message' => 'OTP sent again to your email'
    ]);

}

}
