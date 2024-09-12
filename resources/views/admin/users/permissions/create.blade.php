@extends('admin.body.dashboard')
@section('title')
Create A Permission
@endsection
@section('content')
    <div class="card">

        <div class="card-header">Permissions</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Permission </h6>

                    <form method="POST" action="{{ route('permission.store') }}"  class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="name">
                        </div>
                        @error('name')
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
