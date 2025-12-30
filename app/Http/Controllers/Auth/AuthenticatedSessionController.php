<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\Verifytoken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    public function create()
{
    return view('auth.login');
}

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (auth()->attempt($request->only('email', 'password'))) {

        $user = auth()->user();

        if ($user->is_active == 0) {

            // ✅ STORE EMAIL IN SESSION
            session(['email' => $user->email]);

            // logout AFTER storing session
            auth()->logout();

            return redirect()->route('verify.account')
                ->with('error', 'Please verify your account.');
        }

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials'
    ]);
}

  
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
