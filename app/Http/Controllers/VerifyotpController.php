<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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




}
