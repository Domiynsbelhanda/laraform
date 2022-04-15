<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();

        if (! $user) {
            return redirect()->route('login');
        }

        $user->email_token = null;
        $user->save();

        auth()->login($user);

        return redirect()->route('forms.index');
    }
}
