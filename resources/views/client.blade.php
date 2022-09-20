@extends('layouts.master')

@section('content')
<div class="contents">
    <div class="content-title">
        <div>
            <h4>Clients Info <span class="badge">{{ count($clientAll) }}</span></h4>
        </div>
        {{-- <div class="w-50">
            <form action="{{ route('leads.search') }}" method="Get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="search_data" aria-describedby="button-addon2">
                    <button class="btn" type="submit" id="button-addon2"><i class="fa-light fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div> --}}
        <div>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                New Client
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Lead Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col border-end">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-light fa-user"></i></span>
                                            <input type="text" name="name" id="" value="{{ old('name') }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                                        </div>
                                        @error('name')
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
                                            <span class="input-group-text"><i class="fa-light fa-briefcase"></i></span>
                                            <input type="text" name="job_title" id="" value="{{ old('job_title') }}" placeholder="Job Title" class="form-control @error('job_title') is-invalid @enderror">
                                        </div>
                                        @error('job_title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-light fa-building-columns"></i></span>
                                            <input type="text" name="company" id="" value="{{ old('company') }}" placeholder="Company" class="form-control @error('company') is-invalid @enderror">
                                        </div>
                                        @error('company')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-light fa-map-location-dot"></i></span>
                                            <input type="text" name="city" id="" value="{{ old('city') }}" placeholder="City" class="form-control @error('city') is-invalid @enderror">
                                        </div>
                                        @error('city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                
                                    </div>
                                    <div class="col">        
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-light fa-location-dot"></i></span>
                                            <input type="text" name="address" id="" value="{{ old('address') }}" placeholder="Address" class="form-control @error('address') is-invalid @enderror">
                                        </div>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-light fa-circle-exclamation"></i></span>
                                            <input type="text" disabled name="status" value="Potential" class="form-control @error('status') is-invalid @enderror">
                                        </div>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
        
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-hashtag"></i></label>
                                            <select class="form-select" name="source" value="{{ old('source') }}" id="inputGroupSelect01">
                                                <option selected>Source</option>
                                                <option value="by company">By Company</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="google">Google</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="linkedin">Linkedin</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                        @error('source')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-user-check"></i></label>
                                            <select class="form-select" name="assign" value="{{ old('assign') }}" id="inputGroupSelect01">
                                                <option selected>Assigned To</option>
                                                @foreach($staffs as $staff)
                                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('assign')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="fa-light fa-arrow-up-wide-short"></i></label>
                                            <select class="form-select" name="priority" value="{{ old('priority') }}" id="inputGroupSelect01">
                                                <option selected>Priority</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
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
                                </div>
                                <div class="row mt-3">
                                    <div class="col d-flex justify-content-center">
                                        <input type="submit" class="btn m-auto btn-success w-25" value="Create">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail mt-5">
        <div class="row">
            @foreach($clients as $client)
            <div class="col-lg-3 d-flex justify-content-center mb-5">
                <div class="profile-card">
                    <div class="hover-box">
                        <div class="up">
                            <button> View Details </button>
                        </div>
                        <div class="down">
                            <button><i class="fa-light fa-user-pen"></i></button> 
                            <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button><i class="fa-light fa-trash-can"></i></button>
                            </form>                                                    
                        </div>
                    </div>
                    <div class="card-border-top"></div>
                    <div class="img">
                        <img src="../images/{{ $client->image }}" alt="">
                    </div>
                    <span>{{ $client->name }}</span>
                    <p class="info first"><i class="fa-light fa-briefcase"></i> <span>{{ $client->job_title }}</span></p>
                    <p class="info"><i class="fa-light fa-envelope"></i> <span>{{ $client->email }}</span></p>
                    <p class="info"><i class="fa-light fa-mobile"></i> <span>{{ $client->phone_number }}</span></p>
                    <p class="info"><i class="fa-light fa-building-columns"></i> <span>{{ $client->company }}</span></p>
                </div>
            </div> 
            @endforeach           
        </div>
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                
                {{ $clients->links() }}
              
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