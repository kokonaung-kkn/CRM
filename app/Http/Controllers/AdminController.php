<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $all_staff = User::where('is_admin',1)->get();
        return view('admin',compact('all_staff'));
    }
}
