<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $all_staff = User::where('is_admin',1)->get();
        return view('admin',compact('all_staff'));
    }

    public function store(StoreUserRequest $request)
    {
        $staff = new User();
        $staff->name = $request->name;
        $staff->role = $request->role;
        $staff->email = $request->email;
        $staff->is_admin = 1;
        $staff->phone_number = $request->phone_number;
        $staff->password = bcrypt('password');
        
        $imgName = date('dmyhms').'.'.request()->profile_img->getClientOriginalExtension();
        request()->profile_img->move(public_path('images'),$imgName);
        $staff->profile_img = $imgName;

        $staff->save();
        return redirect('admin')->with('success','New admin is created.');
    }

    public function edit(User $staff)
    {
        return view('editStaff',compact('staff'));
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect('admin')->with('success','The Information is deleted successfully.');
    }
}
