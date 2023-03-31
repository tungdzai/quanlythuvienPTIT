<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function login()
    {
        return view('auth.admin.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $user=Auth::guard('admin')->user();
            session()->put('admin',$user);
            return redirect()->route("admin.dashboard");
        }
        session()->flash("error", __('messages.errors.login'));
        return redirect()->back();

    }
}
