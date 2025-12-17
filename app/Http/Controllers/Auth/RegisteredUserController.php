<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use App\Models\Verifytoken;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
       public function create()
    {
        return view('auth.register'); // your signup form view
    }

public function store(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|confirmed|min:6',
    ]);

    // 2️⃣ Create user as inactive
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_active' => 0,   // inactive until OTP verified
        'role' => 'user',
    ]);

    // 3️⃣ Generate OTP
    $otp = rand(100000, 999999);

    Verifytoken::create([
        'email' => $user->email,
        'token' => $otp,
        'expires_at' => Carbon::now()->addMinutes(5),
    ]);

    // 4️⃣ Send OTP email
    Mail::raw("Your verification OTP is: $otp", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Account Verification OTP');
    });

    // 5️⃣ Store email in session for OTP verification
    session(['otp_email' => $user->email]);

    // 6️⃣ Redirect to OTP page
    return redirect()->route('verify.account')
                     ->with('status', 'OTP sent to your email. Please verify your account.');
}


 
}
