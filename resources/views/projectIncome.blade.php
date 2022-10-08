@extends('layouts.master')

@section('chart-js-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Projects Income Report</h4>
        </div>
    </div>
    <div class="content-detail mt-3">
        <div class="row">
            <div class="col">
                <form action="{{ route('reports.project.date') }}" method="POST">
                @csrf
                    <div class="cal d-flex justify-content-center">
                        
                            <div class="d-flex me-5">
                                <label for="" class="col-form-label me-2">From</label>
                                <input type="date" name="from" class="form-control" value="{{ $from }}">
                            </div>
                            <div class="d-flex me-5">
                                <label for="" class="col-form-label me-2">To</label>
                                <input type="date" name="to" class="form-control" value="{{ $to }}">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Search">
                        
                    </div>  
            </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-white d-flex justify-content-between">
                        <h5>Income Report</h5>
                        <span></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripe">
                            <thead>
                                <th>#</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th>Budget</th>                                
                                <th>Expense</th>                                
                                <th>Profit</th>                                
                            </thead>
                            <tbody>
                                <?php 
                                    $count = 1;
                                    $income = 0;
                                    $expense = 0;
                                    $profit = 0;
                                ?>
                                @foreach($prj_income as $prj)
                                <tr>                                   
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $prj->title }}</td>
                                    <td>{{ $prj->date }}</td>
                                    <td>${{ $prj->income }}</td> 
                                    <td>${{ $prj->expense }}</td> 
                                    <td>${{ $prj->income - $prj->expense }}</td> 
                                    <?php $income += $prj->income ?>                                   
                                    <?php $expense += $prj->expense ?>
                                    <?php $profit += $prj->income - $prj->expense ?>                
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="3"><span class="float-end">Total Budget</span></td>
                                    <td>
                                        <span class="float-start">${{ $income }}</span>
                                        <span class="float-end">Total Expense</span>
                                    </td>
                                    <td>
                                        <span class="float-start">${{ $expense }}</span>
                                        <span class="float-end">Total Profit</span>
                                    </td>
                                    <td>
                                        <span>${{ $profit }}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const data = {
            labels: ['Budget', 'Expense', 'Profit'],
            datasets: [
                {
                    data: [{{ $income }},{{ $expense }},{{ $profit }}],
                    backgroundColor: ['#6384FF', '#FF6384', '#63FF84'],
                }
            ]
        };
    
        const config = {
            type: 'pie',
            data: data,
        };
    
        const income_report = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</div>
@endsection

