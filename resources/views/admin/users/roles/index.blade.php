@extends('admin.body.dashboard')

@section('title')
Roles & Permissions
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Roles & Permissions</h1>
        </div>
        <div class="card-body">
            <a style="margin: 25px" class="btn btn-inverse-primary" href="{{ route('role.create') }}">Create</a>

            @if($roles->isEmpty())
                <h5 style="text-align: center;">There are no roles available</h5>
            @else
                <div class="accordion" id="accordionExample">
                    @foreach ($roles as $role)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="role-heading{{ $role->id }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#role-collapse{{ $role->id }}" aria-expanded="false" aria-controls="role-collapse{{ $role->id }}">
                                    {{ $role->name }}
                                </button>
                            </h2>
                            <div id="role-collapse{{ $role->id }}" class="accordion-collapse collapse" aria-labelledby="role-heading{{ $role->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if($role->permissions->isEmpty())
                                        <p>No permissions assigned to this role</p>
                                    @else
                                        <ul>
                                            @foreach ($role->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a href="{{ route('role.edit',$role->id) }}" class="btn btn-sm btn-inverse-primary">Edit Role With Permissions</a>
                                    <form action="" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-inverse-danger">Delete Role With Permissions</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
