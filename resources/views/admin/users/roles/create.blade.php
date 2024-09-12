@extends('admin.body.dashboard')

@section('title')
Create Role & Permissions
@endsection

@section('content')
<div class="card">
    <div class="card-header">Create Role & Permissions</div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create A New Role</h6>
                <a style="margin: 25px" class="btn btn-inverse-primary" href="{{ route('role.store') }}">All Roles</a>
                <form method="POST" action="{{ route('role.store') }}" class="forms-sample">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" placeholder="Role name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="form-check">
                            @foreach ($permissions as $permission)
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    class="form-check-input"
                                    id="permission{{ $permission->id }}">
                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                                <br>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
