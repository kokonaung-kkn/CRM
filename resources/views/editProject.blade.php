@extends('layouts.master')

@section('multi-select-link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" integrity="sha512-3lMc9rpZbcRPiC3OeFM3Xey51i0p5ty5V8jkdlNGZLttjj6tleviLJfHli6p8EpXZkCklkqNt8ddSroB3bvhrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="contents">
        <div class="card mt-5" style="width: 50rem;margin: auto;">
            <div class="card-header text-white">
                <h3>Edit Project Infomation</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.update',$task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <span class="input-group-text">Project Title</span>
                        <input type="text" name="title" id="" value="{{ old('title',$task->title) }}" class="form-control @error('title') is-invalid @enderror">
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <input type="text" name="desc" id="" value="{{ old('desc',$task->description) }}" class="form-control @error('desc') is-invalid @enderror">
                    </div>
                    @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Client</span>
                        <select name="lead" class="form-control @error('lead') is-invalid @enderror">
                            @foreach($leads as $lead)
                            <option {{ $task->lead_id == $lead->id ? 'selected' : '' }} value='{{ $lead->id }}'>{{ $lead->name }}</option>
                            @endforeach
                        </select> 
                    </div>
                    @error('lead')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Budget</span>
                        <input type="number" name="budget" id="" value="{{ old('budget',$task->budget) }}" class="form-control @error('budget') is-invalid @enderror">
                    </div>
                    @error('budget')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex mb-3">
                        <span class="input-group-text" style="background: #353a56;color: #eaeef4;">Progress Status</span>
                        <input type="range" value="{{ old('progress',$task->progress) }}" class="form-range ms-2 me-2 @error('progress') is-invalid @enderror"" name="progress" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
                        <output>{{ $task->progress.'%' }}</output>
                    </div>
                    @error('progress')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Start time</span>
                        <input type="datetime-local" name="start" id="" value="{{ old('start',$task->start_time) }}" class="form-control @error('start') is-invalid @enderror">
                    </div>
                    @error('start')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">End time</span>
                        <input type="datetime-local" name="end" id="" value="{{ old('end',$task->end_time) }}" class="form-control @error('end') is-invalid @enderror">
                    </div>
                    @error('end')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 d-flex">
                        <label style="border: none;" class="input-group-text me-2">Assign Staff</label>
                        <select multiple="multiple" id="my-select" name="my_select[]">
                            <?php $staffid = [] ?>
                            @foreach($staffs as $s)
                                <?php array_push($staffid,$s->user_id) ?>
                            @endforeach

                            @foreach($allStaff as $staff)                                
                                <option {{ in_array($staff->id,$staffid)  ? 'selected' : '' }} value='{{ $staff->id }}'>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('my-select')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex  justify-content-between">
                        <a href="/tasks" class="btn btn-dark">Back</a>
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('multi-select-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js" integrity="sha512-vSyPWqWsSHFHLnMSwxfmicOgfp0JuENoLwzbR+Hf5diwdYTJraf/m+EKrMb4ulTYmb/Ra75YmckeTQ4sHzg2hg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection