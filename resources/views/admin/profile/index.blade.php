@extends('admin.body.dashboard')
@section('title')
{{ auth()->user()->name}} | Profile
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-2 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="h4 ms-3 text">{{ auth()->user()->name }}</span>
                            <div><img class="wd-100 rounded-circle" src="{{ auth()->user()->avatar }}" alt="profile">
                            </div>

                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
                            <p class="text-muted">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">

                    </div>
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Update Profile </h6>

                            <form method="POST" action="{{ route('admin.profile.edit')}}" enctype="multipart/form-data" class="forms-sample">
                                @csrf
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}" id="">
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ auth()->user()->name }}" id="exampleInputUsername1" autocomplete="off"
                                        placeholder="Name">
                                        @error('name')
                                       <div class="alert alert-danger">
                                        {{ $message }}
                                       </div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}"
                                        class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">
                                 {{ $message }}
                                </div>
                                 @enderror

                                <input class="form-control" type="file" id="image" name="avatar">
                                <br>

                                <div><img id="showimage" class="wd-100 rounded-circle" src="{{ auth()->user()->avatar }}"
                                        alt="profile">
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-secondary">Cancel</button>
                            </form>
                            <hr>
                            <br>
                            <h6 class="card-title">Change Password </h6>

                            <form class="forms-sample" method="POST" action="{{ route('admin.change_password') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password"
                                        autocomplete="off" placeholder="Current Password">
                                </div>
                                @error('current_password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                        autocomplete="off" placeholder="New Password">
                                </div>
                                @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" autocomplete="off" placeholder="Confirm New Password">
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-xl-3">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">

                        </div>
                    </div>

                </div>
            </div>
            <!-- right wrapper end -->
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>
@endsection
