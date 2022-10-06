@extends('layouts.master')

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Staff Info</h4>
        </div>
        <div>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                New Staff
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Staff Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                    <input type="text" name="name" id="" value="{{ old('name') }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-light fa-id-badge"></i></span>
                                    <input type="text" name="role" id="" value="{{ old('role') }}" placeholder="Role" class="form-control @error('role') is-invalid @enderror">
                                </div>
                                @error('role')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-light fa-envelope"></i></span>
                                    <input type="email" name="email" id="" value="{{ old('email') }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-light fa-mobile"></i></span>
                                    <input type="tel" name="phone_number" id="" value="{{ old('phone_number') }}" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror">
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
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone Number</th>                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1 ?>
                        @foreach($all_staff as $staff)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $staff->name }}</td>
                                <td><span class="badge bg-success rounded-pill">{{ $staff->role }}</span></td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->phone_number }}</td>
                                <td class="d-flex">
                                    @if(auth()->user()->is_admin == 1 || auth()->user()->id == $staff->id)
                                    <a href="{{ route('staff.edit',$staff->id) }}" class="btn btn-secondary me-2"><i class="uil uil-edit"></i></a>
                                    <form action="{{ route('staff.destroy',$staff->id) }}" method="POST">
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