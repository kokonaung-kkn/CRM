<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function projectIncome(Request $request){
        $from = empty($request->from) ? date('Y-m-01') : $request->from;
        $a_date = date('Y-m-d');
        $to = empty($request->to) ? date("Y-m-t", strtotime($a_date)) : $request->to;
        $prj_income = db::table('tasks')
                    ->selectRaw('tasks.title AS title, DATE(tasks.start_time) AS date, tasks.budget AS income, SUM(expenses.amount) AS expense')
                    ->leftJoin('expenses','tasks.project_no','expenses.task_id')
                    ->whereRaw("DATE(start_time) BETWEEN '2022-01-1' AND '2022-09-18'")
                    ->groupBy('tasks.title','tasks.start_time','tasks.budget')
                    ->get();
        return view('projectIncome', compact('from','to','prj_income'));
    }
    // SELECT tasks.title AS title, DATE(tasks.start_time) AS date, tasks.budget AS income, expenses.amount AS expense FROM tasks
    // LEFT JOIN expenses ON tasks.project_no = expenses.task_id WHERE DATE(start_time) BETWEEN '2022-01-1' AND '2022-09-18' GROUP BY title
}
