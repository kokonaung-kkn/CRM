@extends('layouts.master')

@section('content')
    <div class="contents">
        <div class="card mt-5 mb-5" style="width: 50rem;margin: auto;">
            <div class="card-header">
                <h3>Edit {{ Request::segment(1) == 'leads' ? 'Lead' : 'Client'}} Infomation</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('leads.update',$lead->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col border-end">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                <input type="text" name="name" id="" value="{{ old('name',$lead->name) }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-envelope"></i></span>
                                <input type="email" name="email" id="" value="{{ old('email',$lead->email) }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-mobile"></i></span>
                                <input type="tel" name="phone_number" id="" value="{{ old('phone_number',$lead->phone_number) }}" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror">
                            </div>
                            @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-briefcase"></i></span>
                                <input type="text" name="job_title" id="" value="{{ old('job_title',$lead->job_title) }}" placeholder="Job Title" class="form-control @error('job_title') is-invalid @enderror">
                            </div>
                            @error('job_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-building-columns"></i></span>
                                <input type="text" name="company" id="" value="{{ old('company',$lead->company) }}" placeholder="Company" class="form-control @error('company') is-invalid @enderror">
                            </div>
                            @error('company')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-map-location-dot"></i></span>
                                <input type="text" name="city" id="" value="{{ old('city',$lead->city) }}" placeholder="City" class="form-control @error('city') is-invalid @enderror">
                            </div>
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror   
                        </div>
                        <div class="col">        
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-location-dot"></i></span>
                                <input type="text" name="address" id="" value="{{ old('address',$lead->address) }}" placeholder="Address" class="form-control @error('address') is-invalid @enderror">
                            </div>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-circle-exclamation"></i></span>
                                <input type="text" disabled value="{{ ucfirst($lead->status) }}" class="form-control">
                            </div>
                            
                            <input type="hidden" name="status" value="{{ $lead->status }}">

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-hashtag"></i></label>
                                <select class="form-select" name="source" id="inputGroupSelect01">
                                    <option>Source</option>
                                    <option {{ $lead->lead_source == 'By company' ? 'selected' : '' }}>By Company</option>
                                    <option {{ $lead->lead_source == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option {{ $lead->lead_source == 'Google' ? 'selected' : '' }}>Google</option>
                                    <option {{ $lead->lead_source == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                    <option {{ $lead->lead_source == 'Linkedin' ? 'selected' : '' }}>Linkedin</option>
                                    <option {{ $lead->lead_source == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                            @error('source')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-user-check"></i></label>
                                <select class="form-select" name="assign" value="{{ old('assign') }}" id="inputGroupSelect01">
                                    <option>Assigned To</option>
                                    @foreach($staffs as $staff)
                                        <option {{ $lead->staff_id == $staff->id ? 'selected' : '' }} value="{{ $staff->id }}">{{ $staff->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('assign')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-arrow-up-wide-short"></i></label>
                                <select class="form-select" name="priority" value="{{ old('priority') }}" id="inputGroupSelect01">
                                    <option>Priority</option>
                                    <option {{ $lead->priority == 1 ? 'selected' : '' }} value="1">1</option>
                                    <option {{ $lead->priority == 2 ? 'selected' : '' }} value="2">2</option>
                                    <option {{ $lead->priority == 3 ? 'selected' : '' }} value="3">3</option>
                                </select>
                            </div>
                            @error('priority')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                            
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-light fa-image"></i></span>
                                <input type="file" class="form-control @error('profile_img') is-invalid @enderror" name="profile_img" id="">
                            </div>
                            @error('profile_img')
                                <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
                        </div>
                        <div class="d-flex  justify-content-between">
                            <a href="/{{ Request::segment(1) == 'leads' ? 'leads' : 'clients'}}" class="btn btn-dark">Back</a>
                            <input type="submit" class="btn btn-info" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection