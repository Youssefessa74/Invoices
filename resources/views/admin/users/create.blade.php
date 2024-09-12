@extends('admin.body.dashboard')
@section('title')
    Create User
@endsection
@section('content')
    <div class="card">

        <div class="card-header">Users</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new User </h6>

                    <form method="POST" action="{{ route('user.store') }}" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="email">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control  @error('password') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control  @error('password_confirmation') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="password_confirmation">
                        </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="role_name" class="form-label">Role Names</label>
                            <select class="form-control @error('role_name') is-invalid @enderror" name="role_name[]"
                                id="role_name" multiple>
                                <option disabled value="">Choose The Role Names</option>
                                @foreach ($role_names as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, old('role_name', [])) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Role</label>
                            <select class="form-control  @error('role') is-invalid @enderror" name="role"
                                id="role">
                                <option selected disabled value="">Choose The Status</option>
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status </label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option selected disabled value="">Choose The Status</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <br>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
