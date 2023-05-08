<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }


    //add new admin
    public function adminDashboard()
    {
        $admins = User::where([['role', '=', 'admin'], ['is_super_admin', '=', null]])->get();
        return view('dashboard.admin.add-admin', compact('admins'));
    }
}
