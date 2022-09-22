<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Staff;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leadAll = Lead::where('status','potential')->get();
        $leads = Lead::where('status','potential')->paginate(8);
        $staffs = Staff::all();
        return view('lead',compact('leadAll','leads','staffs'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:leads',
            'phone_number' => 'required|unique:leads',
            'job_title' => 'required',
            'company' => 'required',
            'city' => 'required',
            'address' => 'required',
            'source' => 'required',
            'assign' => 'required',
            'priority' => 'required',
            'profile_img' => 'required|image',
        ]);

        $imgName = date('dmyhms').'.'.request()->profile_img->getClientOriginalExtension();
        request()->profile_img->move(public_path('images'),$imgName);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'job_title' => $request->job_title,
            'company' => $request->company,
            'city' => $request->city,
            'address' => $request->address,
            'lead_source' => $request->source,
            'staff_id' => $request->assign,
            'priority' => $request->priority,
            'status' => strtolower($request->status),
            'image' => $imgName
        ]);

        if($request->status == 'Potential'){
            return redirect('/leads')->with('success','New Lead is created.');
        }else{
            return redirect('/clients')->with('success','New Client is created.');
        }
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
    public function edit(Lead $lead)
    {
        $staffs = Staff::all();
        return view('editLead',compact('lead','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'job_title' => 'required',
            'company' => 'required',
            'city' => 'required',
            'address' => 'required',
            'profile_img' => 'image',
        ]);

        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone_number = $request->phone_number;
        $lead->job_title = $request->job_title;
        $lead->company = $request->company;
        $lead->city = $request->city;
        $lead->address = $request->address;

        if($request->source){
            $lead->lead_source = $request->source;
        }

        if($request->assign){
            $lead->staff_id = $request->assign;
        }

        if($request->priority){
            $lead->priority = $request->priority;
        }

        if($request->profile_img){
            $imgName = date('dmyhms').'.'.$request->profile_img->getClientOriginalExtension();
            $request->profile_img->move(public_path('images'),$imgName);
            $lead->image = $imgName;
        }
        $lead->save();

        if($request->status == 'Potential'){
            return redirect('/leads')->with('success','The information has been updated.');
        }else{
            return redirect('/clients')->with('success','The information has been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect('leads')->with('success','The information is deleted.');
    }

    public function convert(Lead $lead){
        $lead->status = 'Client';
        $lead->save();
        return redirect('leads')->with('success','Lead '.$lead->name.' is converted to client.');
    }

    public function search(Request $request){
        if($request->search_data === null){
            return redirect()->route('leads.index');
        }else{
            $leadAll = Lead::where('status','potential')->get();
            $staffs = Staff::all();
            $leads = Lead::where('status','potential')
                            ->where("name", "LIKE", "%$request->search_data%")
                            ->orWhere('email', 'LIKE',"%$request->search_data%")
                            ->paginate();
            return view('lead',compact('leadAll','leads','staffs'));
        }
    }
}
