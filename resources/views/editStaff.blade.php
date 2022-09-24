@extends('layouts.master')

@section('content')
    <div class="contents">
        <div class="card mt-5" style="width: 50rem;margin: auto;">
            <div class="card-header">
                <h3>Edit Staff Infomation</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.update',$staff->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                        <input type="text" name="name" id="" value="{{ old('name',$staff->name) }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-id-badge"></i></span>
                        <input type="text" name="role" id="" value="{{ old('role',$staff->role) }}" placeholder="Role" class="form-control @error('role') is-invalid @enderror">
                    </div>
                    @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-briefcase"></i></span>
                        <input type="text" name="job_title" id="" value="{{ old('job_title',$staff->job_title) }}" placeholder="Job Title" class="form-control @error('job_title') is-invalid @enderror">
                    </div>
                    @error('job_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-envelope"></i></span>
                        <input type="email" name="email" id="" value="{{ old('email',$staff->email) }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-mobile"></i></span>
                        <input type="tel" name="phone_number" id="" value="{{ old('phone_number',$staff->phone_number) }}" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror">
                    </div>
                    @error('phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-light fa-image"></i></span>
                        <input type="file" class="form-control @error('profile_img') is-invalid @enderror" name="profile_img" id="">
                    </div>
                    @error('profile_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 d-flex align-items-center">
                        <span class="input-group-text" style="background-color: #353a56; color:#eaeef4">Admin</span>
                        <div class="text-center w-75">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{ $staff->is_admin == 1 ? 'checked' : '' }} type="radio" name="is_admin" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" {{ $staff->is_admin == 0 ? 'checked' : '' }} type="radio" name="is_admin" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex  justify-content-between">
                        <a href="/staff" class="btn btn-dark">Back</a>
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection