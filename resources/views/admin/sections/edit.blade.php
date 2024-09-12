@extends('admin.body.dashboard')
@section('title')
Edit Section
@endsection
@section('content')
    <div class="card">

        <div class="card-header">Sections</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit Section </h6>

                    <form method="POST" action="{{ route('sections.update',$section->id) }}"  class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $section->name }}" class="form-control  @error('name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $section->description }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status </label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option selected disabled value="">Choose The Status</option>
                                <option @selected($section->status == 1) value="1">Active</option>
                                <option @selected($section->status == 0) value="0">In Active</option>
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
