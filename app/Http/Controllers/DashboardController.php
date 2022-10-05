<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Payment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $allLeads = Lead::where('status','potential')->get();
        $allClients = Lead::where('status','client')->get();
        $allStaffs = User::all();
        $allProjects = Task::all();
        $MonthlyProj = $this->monthlyProjectReport();
        $incomes = $this->income();
        $expenses = $this->expense();
        return view('dashboard',compact(
            'allLeads','allClients','allStaffs','allProjects','MonthlyProj','incomes','expenses'
        ));
    }

    public function monthlyProjectReport(){
        $MonthlyProj = DB::table('tasks')
                        ->selectRaw("DATE_FORMAT(tasks.start_time, '%b') AS Months, COUNT(MONTH(tasks.start_time)) AS Count")
                        ->whereRaw("YEAR(start_time) = YEAR(CURDATE())")
                        ->groupBy('Months')
                        ->get();
        return $MonthlyProj;
        //SELECT DATE_FORMAT(tasks.start_time, '%b') AS 'Months', COUNT(MONTH(tasks.start_time)) AS 'Count' from tasks WHERE YEAR(start_time) = YEAR( CURDATE() ) GROUP BY Months
    }

    public function income(){
        $income = DB::table('payments')
                ->selectRaw("DATE_FORMAT(Date, '%b') AS Months, SUM(amount) as Total")
                ->where('status','paid')
                ->whereRaw('YEAR(Date) = YEAR(CURDATE())')
                ->groupBy('Months')
                ->get();
        return $income;
    }

    public function expense(){
        $expense = DB::table('Expenses')
                ->selectRaw("DATE_FORMAT(Date, '%b') AS Months, SUM(amount) as Total")
                ->whereRaw('YEAR(Date) = YEAR(CURDATE())')
                ->groupBy('Months')
                ->get();
        return $expense;
    }
}
