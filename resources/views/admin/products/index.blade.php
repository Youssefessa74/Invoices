@extends('admin.body.dashboard')
@section('title')
Products
@endsection
@section('content')
<div class="container">
    <h1>Products</h1>
    <a style="margin: 25px" class="btn btn-inverse-primary" href="{{ route('products.create') }}">Create</a>

    {!! $dataTable->table() !!}
</div>

<!-- Include DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

{!! $dataTable->scripts() !!}
@endsection
@push('scripts')

@endpush

