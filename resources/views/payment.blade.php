@extends('layouts.master')

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Project Room : {{ $task->title }}</h4>
        </div>
        <div class="d-flex pj-room-nav">
            <a href="{{ route('tasks.show',$task->project_no) }}" class="pj-room-nav-link">Dashboard</a>
            <a href="{{ route('tasks.payment',$task->project_no) }}" class="pj-room-nav-link active">Payment</a>
            <a href="{{ route('tasks.expense',$task->project_no) }}" class="pj-room-nav-link">Expense</a>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a style="color: #353a56; text-decoration: underline;" href="/tasks">Projects</a></li>
          <li class="breadcrumb-item active" aria-current="page">Project Room</li>
        </ol>
    </nav>
    <div class="content-detail mt-3">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5>Payment</h5>
                        <button type="button" class="btn" style="background-color:#353a56;color:#eaeef4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add New Payment
                        </button>
                          
                          <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Create New Expense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('payments.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3 row">
                                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="title" id="title">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="amount" id="amount">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="date" class="col-sm-2 col-form-label">Due</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" name="date" id="date">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-10">
                                                    <select name="status" class="form-select" id="">
                                                        <option value="paid">Paid</option>
                                                        <option value="unpaid">Unpaid</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="task_id" value="{{ $task->project_no }}">
                                            <div class="col d-flex justify-content-center">
                                                <input type="submit" class="btn m-auto btn-success w-25" value="Create">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $count = 1 ?>
                                @foreach($task->payments as $payment)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $payment->title }}</td>
                                    <td>${{ $payment->amount }}</td>
                                    <td>{{ $payment->Date }}</td>
                                    <td><span class="badge {{ $payment->status == 'paid' ? 'bg-success' : 'bg-danger' }}">{{ $payment->status }}</span></td>
                                    <td class="d-flex">
                                        @if($payment->status == 'unpaid')
                                        <form action="{{ route('payments.paid',$payment->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button class="btn btn-dark me-2 text-white"><i class="fa-solid fa-hand-holding-dollar"></i></button>                                    
                                        </form>
                                        @endif
                                        <button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#updatePayment{{ $payment->id }}">
                                            <i class="uil uil-edit"></i>
                                        </button>
                                        <div class="modal fade" id="updatePayment{{ $payment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Update Payment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('payments.update',$payment->id) }}" method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <div class="mb-3 row">
                                                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" value="{{ $payment->title }}" name="title" id="title">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" value="{{ $payment->amount }}" name="amount" id="amount">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="date" class="col-sm-2 col-form-label">Due</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" class="form-control" value="{{ $payment->date }}" name="date" id="date">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-sm-2 col-form-label">Status</label>
                                                                <div class="col-sm-10">
                                                                    <select name="status" class="form-select" id="">
                                                                        <option {{ $payment->status == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                                                                        <option {{ $payment->status == 'unpaid' ? 'selected' : '' }} value="unpaid">Unpaid</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col d-flex justify-content-center">
                                                                <input type="submit" class="btn m-auto btn-success w-25" value="Update">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="uil uil-trash-alt"></i></button>                                    
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="text-center fw-bold">
                                    <td colspan="3">Total budget: ${{ $task->budget }}</td>
                                    <td colspan="3">Total Paid: ${{ $paidTotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header text-white">
                        <h5>Client Info</h5>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="client-img expense ms-3 me-4"><img src="/images/unnamed.png" alt=""></div>
                        <div class="client-info">
                            <div class="client-name expense">{{ $task->lead->name }}</div>
                            <div class="client-job text-muted mb-3">{{ $task->lead->job_title }}</div>
                            <div class="client-social-info d-flex">
                                <a href = "mailto:{{ $task->lead->email }}" class="me-3"><i class="fa-solid fa-envelope"></i></a>
                                <a href="tel:{{ $task->lead->phone_number }}"><i class="fa-solid fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-white">
                        <h5>Assigned Staff</h5>
                    </div>
                    <div class="card-body">
                        @foreach($task->users as $staff)
                        <div class="d-flex align-items-center pb-2 mb-2 border-bottom">
                            <div class="staff-img expense ms-3 me-4"><img src="/images/unnamed.png" alt=""></div>
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