@extends('layouts.master')

@section('multi-select-link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/css/multi-select.min.css" integrity="sha512-3lMc9rpZbcRPiC3OeFM3Xey51i0p5ty5V8jkdlNGZLttjj6tleviLJfHli6p8EpXZkCklkqNt8ddSroB3bvhrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Projects List</h4>
        </div>
        <div>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                New Project
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Project Title</span>
                                    <input type="text" name="title" id="" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                                </div>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Description</span>
                                    <input type="text" name="desc" id="" value="{{ old('desc') }}" class="form-control @error('desc') is-invalid @enderror">
                                </div>
                                @error('desc')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Client</span>
                                    <select name="lead" value="{{ old('lead') }}" class="form-control @error('lead') is-invalid @enderror">
                                        @foreach($leads as $lead)
                                        <option value='{{ $lead->id }}'>{{ $lead->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                                @error('lead')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Budget</span>
                                    <input type="number" name="budget" id="" value="{{ old('budget') }}" class="form-control @error('budget') is-invalid @enderror">
                                </div>
                                @error('budget')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="d-flex mb-3">
                                    <span class="input-group-text" style="background: #353a56;color: #eaeef4;">Progress Status</span>
                                    <input type="range" value="{{ old('progress') }}" class="form-range ms-2 me-2 @error('progress') is-invalid @enderror"" name="progress" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
                                    <output></output>
                                </div>
                                @error('progress')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Start time</span>
                                    <input type="datetime-local" name="start" id="" value="{{ old('start') }}" class="form-control @error('start') is-invalid @enderror">
                                </div>
                                @error('start')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text">End time</span>
                                    <input type="datetime-local" name="end" id="" value="{{ old('end') }}" class="form-control @error('end') is-invalid @enderror">
                                </div>
                                @error('end')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3 d-flex">
                                    <label style="border: none;" class="input-group-text me-2">Assign Staff</label>
                                    <select multiple="multiple" id="my-select" name="my_select[]">
                                        @foreach($staffs as $staff)
                                            <option value='{{ $staff->id }}'>{{ $staff->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('my-select')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-success w-25" value="Create">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail mt-3">
        <div class="card mb-3">
            <div class="card-body">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Project</th>
                            <th>Client</th>
                            <th>Progress</th>
                            <th>Start Date</th>    
                            <th>End Date</th>                       
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->lead->name }}</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $task->progress }}%;" aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $task->progress }}%</div>
                                    </div>
                                </td>
                                <td>{{ $task->start_time }}</td>
                                <td>{{ $task->end_time }}</td>
                                <td class="d-flex">
                                    <a title="Project Room" href="{{ route('tasks.show',$task->project_no) }}" class="btn btn-warning me-2"><i class="uil uil-meeting-board"></i></a>
                                    @if(auth()->user()->is_admin == 1)
                                    <a href="{{ route('tasks.edit',$task->project_no) }}" class="btn btn-secondary me-2"><i class="uil uil-edit"></i></a>
                                    <form action="{{ route('tasks.destroy',$task->project_no) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="uil uil-trash-alt"></i></button>                                    
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach                                               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('alert')
        @if(session('success'))
            <script>
                let info = '{{ session("success") }}';
                Swal.fire(info)
            </script>
        @endif
@endsection

@section('multi-select-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js" integrity="sha512-vSyPWqWsSHFHLnMSwxfmicOgfp0JuENoLwzbR+Hf5diwdYTJraf/m+EKrMb4ulTYmb/Ra75YmckeTQ4sHzg2hg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection