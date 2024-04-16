<?php

namespace App\Http\Controllers\Site\Auth\Password;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;

use App\Http\Controllers\Controller;
use App\Notifications\Auth\SendRequestPasswordResetNotification;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function forgotPasswordEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('toast_error', "We cant find a user with that e-mail address.");
        }

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );

        if ($user && $passwordReset) {
            $user->notify(
                new SendRequestPasswordResetNotification($passwordReset->token)
            );
            return back()->with('toast_success', 'We have e-mailed your password reset link!');
        }
    }
}
