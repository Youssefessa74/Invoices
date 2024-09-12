@extends('admin.body.dashboard')

@section('titles')
    Trashed Invoices
@endsection
@section('content')
<div class="container">
    <h1>Deleted Invoices</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Discount</th>
                <th>Rate VAT</th>
                <th>Value VAT</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->discount }}</td>
                <td>{{ $invoice->rate_vat }}</td>
                <td>{{ $invoice->value_vat }}</td>
                <td>{{ $invoice->total }}</td>
                <td>
                    @if ($invoice->invoice_status == 'paid')
                        <span class="badge badge-success">PAID</span>
                    @else
                        <span class="badge badge-danger">PENDING</span>
                    @endif
                </td>
                <td>

                    <a href="{{ route('force_delete', $invoice->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add pagination links if applicable -->
    {{ $invoices->links() }}
</div>
@endsection
