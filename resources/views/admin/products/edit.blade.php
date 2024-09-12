@extends('admin.body.dashboard')
@section('title')
Edit Product
@endsection
@section('content')
    <div class="card">

        <div class="card-header">Products</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit a Product </h6>

                    <form method="POST" action="{{ route('products.update',$product->id) }}"  class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Name</label>
                            <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control  @error('product_name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="product name">
                        </div>
                        @error('product_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $product->description }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status </label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option selected disabled value="">Choose The Status</option>
                                <option @selected($product->status == 1) value="1">Active</option>
                                <option @selected($product->status == 0) value="0">In Active</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sections</label>
                            <select class="form-control  @error('section_id') is-invalid @enderror" name="section_id"
                                id="section_id">
                                <option selected disabled value="">Choose The Section</option>
                                @foreach ($sections as $item)
                                <option @selected($product->section_id == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('section_id')
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
