<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_staff = User::where('is_admin',0)->get();
        return view('staff',compact('all_staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $staff = new User();
        $staff->name = $request->name;
        $staff->role = $request->role;
        $staff->email = $request->email;
        $staff->is_admin = 0;
        $staff->phone_number = $request->phone_number;
        $staff->password = bcrypt('password');
        
        $imgName = date('dmyhms').'.'.request()->profile_img->getClientOriginalExtension();
        request()->profile_img->move(public_path('images'),$imgName);
        $staff->profile_img = $imgName;

        $staff->save();
        return redirect('staff')->with('success','New Staff is created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        return view('editStaff',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        request()->validate([
            'name' => 'required|max:255',
            'role' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'profile_img' => 'image',
        ]);

        $staff->name = $request->name;
        $staff->role = $request->role;
        $staff->email = $request->email;
        $staff->phone_number = $request->phone_number;
        
        if($request->profile_img){
            $imgName = date('dmyhms').'.'.request()->profile_img->getClientOriginalExtension();
            request()->profile_img->move(public_path('images'),$imgName);
            $staff->profile_img = $imgName;
        }

        $staff->save();
        return redirect('staff')->with('success','The information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect('staff')->with('success','The Information is deleted successfully.');
    }
}
