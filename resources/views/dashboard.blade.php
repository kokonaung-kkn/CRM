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
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
    ];

    const data = {
        labels: labels,
        datasets: [{
        label: 'Income',
            backgroundColor: '#353a56',
            data: [13, 10, 5, 2, 20, 30, 45],
        },
        {
            label: 'Expanse',
            backgroundColor: '#0d1231',
            data: [23, 8, 15, 12, 30, 20, 35],
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