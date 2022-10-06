@extends('layouts.master')

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Project Room : {{ $task->title }}</h4>
        </div>
        @if(auth()->user()->is_admin == 1)        
        <div class="d-flex pj-room-nav">
            <a href="{{ route('tasks.show',$task->project_no) }}" class="pj-room-nav-link active">Dashboard</a>
            <a href="{{ route('tasks.payment',$task->project_no) }}" class="pj-room-nav-link">Payment</a>
            <a href="{{ route('tasks.expense',$task->project_no) }}" class="pj-room-nav-link">Expense</a>
        </div>
        @endif
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a style="color: #353a56; text-decoration: underline;" href="/tasks"><i class="fa-solid fa-folder-open"></i> Projects</a></li>
          <li class="breadcrumb-item active" aria-current="page">Project Room</li>
        </ol>
    </nav>
    <div class="content-detail mt-3">
        <div class="row mb-4">
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-users-gear"></i>
                            <div class="total">{{ count($task->users) }}</div>
                        </div>
                        <div class="card-text">
                            Staff working
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <div class="total">${{ $task->budget }}</div>
                        </div>
                        <div class="card-text">
                            Total Budget
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-credit-card"></i>
                            <div class="total">${{ $paidTotal }}</div>
                        </div>
                        <div class="card-text">
                            Total Amount Paid
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-card card">
                    <div class="card-body">
                        <div class="card-icons">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            <div class="total">{{ $unpaid }}</div>
                        </div>
                        <div class="card-text">
                            Unpaid Invoices
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-white">
                        <h5>Client Info</h5>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="client-img ms-3 me-4"><img src="/images/unnamed.png" alt=""></div>
                        <div class="client-info">
                            <div class="client-name">{{ $task->lead->name }}</div>
                            <div class="client-company">{{ $task->lead->company }}</div>
                            <div class="client-job text-muted mb-3">{{ $task->lead->job_title }}</div>
                            <div class="client-social-info d-flex flex-column">
                                <a href = "mailto:{{ $task->lead->email }}"><i class="fa-solid fa-envelope"></i> {{ $task->lead->email }}</a>
                                <a href="tel:{{ $task->lead->phone_number }}"><i class="fa-solid fa-phone"></i> {{ $task->lead->phone_number }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-white">
                        <h5>Project Progress</h5>
                    </div>
                    <div class="card-body">
                        <div class="project progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $task->progress }}%;" aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $task->progress }}%</div>
                          </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h5>Total Expense</h5>
                        <h6>${{ $totalExpense }}</h6>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <table class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                <?php $count = 1 ?>
                                @foreach($task->expenses as $expense)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $expense->title }}</td>
                                        <td>${{ $expense->amount }}</td>
                                        <td>{{ $expense->Date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-white">
                        <h5>Assigned Staff</h5>
                    </div>
                    <div class="card-body">
                        @foreach($task->users as $staff)
                        <div class="d-flex align-items-center pb-2 mb-2 border-bottom">
                            <div class="staff-img ms-3 me-4"><img src="/images/unnamed.png" alt=""></div>
                            <div class="staff-info">
                                <div class="staff-name">{{ $staff->name }}</div>
                                <div class="staff-job text-muted mb-2">{{ $staff->role }}</div>
                                <div class="staff-social-info d-flex">
                                    <a href = "mailto:{{ $staff->email }}" class="me-3"><i class="fa-solid fa-envelope"></i></a>
                                    <a href="tel:{{ $staff->phone_number }}"><i class="fa-solid fa-phone"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection