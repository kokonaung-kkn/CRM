@extends('layouts.master')

@section('chart-js-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Admin Dashboard</h4>
        </div>
    </div>
    <div class="content-detail mt-2">
        <div class="row">
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-user"></i>
                            <div class="total">{{ count($allLeads) }}</div>
                        </div>
                        <div class="card-text">
                            Total Leads
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-user-tie"></i>
                            <div class="total">{{ count($allClients) }}</div>
                        </div>
                        <div class="card-text">
                            Total Clients
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-users"></i>
                            <div class="total">{{ count($allStaffs) }}</div>
                        </div>
                        <div class="card-text">
                            Team Members
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-folder"></i>
                            <div class="total">{{ count($allProjects) }}</div>
                        </div>
                        <div class="card-text">
                            Total Projects
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <canvas id="incomeVSexpanse" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <canvas id="myChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const income_vs_expense = {
        'Jan' : {'income': 0, 'expense': 0},
        'Feb' : {'income': 0, 'expense': 0},
        'Mar' : {'income': 0, 'expense': 0},
        'Apr' : {'income': 0, 'expense': 0},
        'May' : {'income': 0, 'expense': 0},
        'Jun' : {'income': 0, 'expense': 0},
        'Jul' : {'income': 0, 'expense': 0},
        'Aug' : {'income': 0, 'expense': 0},
        'Sep' : {'income': 0, 'expense': 0},
        'Oct' : {'income': 0, 'expense': 0},
        'Nov' : {'income': 0, 'expense': 0},
        'Dec' : {'income': 0, 'expense': 0}
    }

    @foreach($incomes as $income)
        income_vs_expense['{{ $income->Months }}'].income = {{ $income->Total }}
    @endforeach

    @foreach($expenses as $expense)
        income_vs_expense['{{ $expense->Months }}'].expense = {{ $expense->Total }}
    @endforeach

    let in_ex_months = Object.keys(income_vs_expense)
    let in_ex_total = Object.values(income_vs_expense)
    let income_total = []
    let expense_total = []
    console.log(in_ex_total[0].income)

    for(let i=0; i<in_ex_total.length; i++){
        income_total.push(in_ex_total[i].income)
        expense_total.push(in_ex_total[i].expense)
    }

    console.log(income_total)
    console.log(expense_total)

    const data = {
        labels: in_ex_months,
        datasets: [{
        label: 'Income',
            backgroundColor: '#35ed26',
            data: income_total,
        },
        {
            label: 'Expanse',
            backgroundColor: '#325def',
            data: expense_total,
        }]
    };

    const config = {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Income Vs Expanse'
        }
        }
    }
    };

    const income_expanse = new Chart(
        document.getElementById('incomeVSexpanse'),
        config
    );

    //Monthly Projects Chart

    const month_proj = {
        'Jan' : 0,
        'Feb' : 0,
        'Mar' : 0,
        'Apr' : 0,
        'May' : 0,
        'Jun' : 0,
        'Jul' : 0,
        'Aug' : 0,
        'Sep' : 0,
        'Oct' : 0,
        'Nov' : 0,
        'Dec' : 0
    }

    @foreach($MonthlyProj as $data)
        month_proj.{{ $data->Months }} = {{ $data->Count }}
    @endforeach

    console.log(month_proj)

    let months = Object.keys(month_proj) 
    let count = Object.values(month_proj)

    const months_data = {
        labels: months,
        datasets: [{
        label: 'Project Based on Months',
        backgroundColor: '#353a56',
        borderColor: '#0d1231',
        data: count,
        }]
    };

    const months_config = {
        type: 'line',
        data: months_data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        months_config
    );
</script>
@endsection