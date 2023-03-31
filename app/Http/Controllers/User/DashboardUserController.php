<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index(){
        $data['user']=session('user');
        return view("users.pages.dashboard",$data);
    }
}
