<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function login()
    {
        return view('auth.user.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function handleUserLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            $user=Auth::guard('user')->user();
            session()->put('user',$user);
            return redirect()->route("user.dashboard");
        }
        session()->flash("error", __('messages.errors.login'));
        return redirect()->back();
    }
}
