<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientAll = Lead::where('status','client')->get();
        $clients = Lead::where('status','client')->paginate(8);
        $staffs = User::all();
        return view('client',compact('clientAll','clients','staffs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        $projects = Task::where('lead_id',$lead->id)->get();
        $payments_paid = DB::table('payments')
                            ->selectRaw('payments.*,tasks.title AS project')
                            ->leftJoin('tasks','tasks.project_no','payments.task_id')
                            ->where('tasks.lead_id',$lead->id)
                            ->get();
        $payment_list = [];
        foreach($payments_paid as $payment){
            $payment_list[$payment->project] = [];
        }

        foreach($payments_paid as $payment){
            array_push($payment_list[$payment->project],[
                'title' => $payment->title,
                'amount' => $payment->amount,
                'date' => $payment->Date,
                'status' => $payment->status,
            ]);
        }
        return view('leadDetail',compact('lead','projects', 'payment_list'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        $staffs = User::all();
        return view('editLead',compact('lead','staffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        return redirect('/clients')->with('success','The information is deleted.');
    }

    public function search(Request $request){
        if($request->search_data === null){
            return redirect()->route('clients.index');
        }else{
            $clientAll = Lead::where('status','client')->get();
            $staffs = User::all();
            $clients = Lead::where('status','client')
                            ->where("name", "LIKE", "%$request->search_data%")
                            ->orWhere('email', 'LIKE',"%$request->search_data%")
                            ->paginate();
            return view('client',compact('clientAll','clients','staffs'));
        }
    }
}
