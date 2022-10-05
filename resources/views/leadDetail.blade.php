@extends('layouts.master')

@section('content')
<div class="contents">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card w-50 mb-5">
                <div class="card-header text-center text-light">
                    Lead Information
                </div>
                <div class="card-body">
                    <div class="head d-flex flex-column align-items-center">
                        <div class="mb-3" style="width: 200px;height: 200px; overflow: hidden;border-radius: 50%;">
                            <img style="width: 100%;" src="/images/{{ $lead->image }}" alt="">
                        </div>
                        <div class="user-name">
                            <h4>{{ $lead->name }}</h4>
                        </div>
                    </div>
                    <div class="body">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1">Profile</label>
                            
                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2">Projects</label>
                            
                        <input id="tab3" type="radio" name="tabs">
                        <label for="tab3">Payment</label>
                        
                        <section id="content1">
                            <ul class="list-group">
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Projects</div>
                                    <div>{{ count($projects) }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Email</div>
                                    <div class="w-50">{{ $lead->email }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Phone</div>
                                    <div class="w-50">{{ $lead->phone_number }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Job Title</div>
                                    <div class="w-50">{{ $lead->job_title }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Company</div>
                                    <div class="w-50">{{ $lead->company }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">City</div>
                                    <div class="w-50">{{ $lead->city }}</div>
                                </li>
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-25 ms-5">Address</div>
                                    <div class="w-50">{{ $lead->address }}</div>
                                </li>
                            </ul>
                        </section>
                        <section id="content2">
                            <ul class="list-group">
                                @foreach($projects as $project)
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent d-flex">
                                    <div class="w-50 ms-5">{{ $project->title }}</div>
                                    <div class="w-50">Progress: {{ $project->progress }}%</div>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                        <section id="content3">
                            <ul class="list-group">
                                <?php $keys = array_keys($payment_list) ?>
                                @foreach($keys as $key)
                                <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-transparent">
                                    <span class="outer fw-bold">{{ $key }}</span>
                                    <ul class="mt-3">
                                    @foreach($payment_list[$key] as $each_payment)
                                        <li class="inner d-flex mb-2">
                                            <div class="w-50">{{ $each_payment['title'] }}</div>
                                            <div class="w-25">{{ $each_payment['amount'] }}</div>
                                            <div class="w-25"><span class="badge {{ $each_payment['status'] == 'paid' ? 'bg-success' : 'bg-danger' }}">{{ $each_payment['status'] }}</span></div>
                                            <div class="w-50">{{ $each_payment['date'] }}</div>
                                            
                                        </li>
                                    @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection