<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['edit','destroy','payment','expense']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $staffs = User::all();
        $leads = Lead::all();
        return view('projects',compact('tasks','staffs','leads'));
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
            'title' => 'required',
            'lead' => 'required',
            'budget' => 'required',
            'progress' => 'required',
            'start' => 'required',
            'end' => 'required',
            'my_select' => 'required',
        ]);

        $rand_no = strval(rand(1000, 9999));

        Task::create([
            'project_no' => $rand_no,
            'title' => $request->title,
            'description' => $request->desc,
            'lead_id' => $request->lead,
            'budget' => $request->budget,
            'progress' => $request->progress,
            'start_time' => $request->start,
            'end_time' => $request->end,
            'assign_from' => Auth::id()
        ]);

        $staff_list = $request->my_select;
        foreach($staff_list as $staff){
            TaskUser::create([
                'user_id' => $staff,
                'task_id' => $rand_no,
            ]);
        };
        
        return redirect('/tasks')->with('success', 'New Project is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $totalExpense = Expense::where('task_id',$task->project_no)->sum('amount');
        $paidTotal = Payment::where('task_id',$task->project_no)
            ->where('status','paid')
            ->sum('amount');
        $unpaid = Payment::where('task_id',$task->project_no)
            ->where('status','unpaid')
            ->count('id');
        return view('projectroom',compact('task','totalExpense','paidTotal', 'unpaid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $leads = Lead::all();
        $allStaff = User::all();
        $staffs = DB::table('users')
                ->select('*')->leftjoin('task_users','users.id','task_users.user_id')
                ->where('task_users.task_id',$task->project_no)
                ->get();
        return view('editProject',compact('task','staffs','leads','allStaff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'lead' => 'required',
            'budget' => 'required',
            'progress' => 'required',
            'start' => 'required',
            'end' => 'required',
            'my_select' => 'required',
        ]);

        $task->title = $request->title;
        $task->description = $request->desc;
        $task->lead_id = $request->lead;
        $task->budget = $request->budget;
        $task->progress = $request->progress;
        $task->start_time = $request->start;
        $task->end_time = $request->end;
        $task->assign_from = Auth::id();

        TaskUser::where('task_id',$task->project_no)->delete();

        $staff_list = $request->my_select;
        foreach($staff_list as $staff){
            TaskUser::create([
                'user_id' => $staff,
                'task_id' => $task->project_no,
            ]);
        };
        $task->save();
        return redirect('/tasks')->with('success', 'The information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        TaskUser::where('task_id',$task->project_no)->delete();
        return redirect('/tasks')->with('success','The information is deleted.');
    }

    public function expense(Task $task)
    {
        return view('expense',compact('task'));
    }

    public function payment(Task $task)
    {
        $paidTotal = Payment::where('task_id',$task->project_no)
            ->where('status','paid')
            ->sum('amount');
        return view('payment',compact('task','paidTotal'));
    }
}
