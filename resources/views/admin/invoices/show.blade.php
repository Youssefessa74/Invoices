@extends('admin.body.dashboard')
@section('title')
    Invoices Details
@endsection
@section('content')
    <div id="print_card" class="card">
        <div class="card-body">
            <div class="container-fluid d-flex justify-content-between">
                <!-- Invoice Info -->
                <div class="col-lg-3 ps-0">
                    <a style="margin: 25px" class="btn btn-inverse-primary" href="{{ route('invoices.index') }}">All
                        Invoices</a>
                    <a href="#" class="noble-ui-logo logo-light d-block mt-3">Home<span>Invoices</span></a>
                    <h5 class="mt-5 mb-2 text-muted">Invoice Created By :</h5>
                    <p>
                        {{ @$invoice->user->name }},<br>
                        {{ @$invoice->user->email }}<br>
                        {{ @$invoice->user->phone }}
                    </p>
                </div>

                <!-- Invoice Summary -->
                <div class="col-lg-3 pe-0">
                    <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">Invoice</h4>
                    <h6 class="text-end mb-5 pb-4"># {{ $invoice->invoice_number }}</h6>
                    <p class="text-end mb-1">Invoice Status</p>
                    <h4 class="text-end fw-normal">{{ ucfirst($invoice->invoice_status) }}</h4>

                    <h6 class="mb-0 mt-3 text-end fw-normal">
                        <span class="text-muted">Invoice Date :</span>
                        {{ $invoice->invoice_Date }}
                    </h6>
                    <h6 class="mb-0 mt-3 text-end fw-normal">
                        <span class="text-muted">Due Date :</span>
                        {{ $invoice->due_date }}
                    </h6>
                </div>
            </div>



            <!-- Invoice Details Table -->
            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-end">
                                <td class="text-start">#</td>
                                <td>{{ $invoice->product->product_name }}</td>
                                <td>{{ $invoice->section->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Details Table -->
            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->details as $detail)
                                <tr class="text-end">
                                    <td class="text-start">{{ $loop->iteration }}</td>

                                    <td>{{ ucfirst($detail->status) }}</td>
                                    <td>{{ $detail->note ?? 'N/A' }}</td>
                                    <td>{{ $detail->user }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Summary -->
            <div class="container-fluid mt-5 w-100">
                <div class="row">
                    <div class="col-md-6 ms-auto d-print-none">
                        <h2>Invoice Summary</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Amount Commission</td>
                                        <td class="text-end">{{ number_format($invoice->Amount_commission, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount Collection</td>
                                        <td class="text-end">
                                            {{ $invoice->Amount_collection ? number_format($invoice->Amount_collection, 2) : 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td class="text-end">
                                            {{ $invoice->discount ? number_format($invoice->discount, 2) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>VAT Rate</td>
                                        <td class="text-end">{{ $invoice->rate_vat }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Value VAT</td>
                                        <td class="text-end">{{ number_format($invoice->value_vat, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="text-end">{{ number_format($invoice->total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 w-100">
                        <div class="row">
                            <div class="col-md-6 ms-auto d-print-none">
                                <div class="col-lg-8">
                                    <div class="col-md-8 d-print-none">
                                        <form action="{{ route('invoice_change_status',$invoice->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select class="form-control" name="invoice_status" id="">
                                                    <option @selected($invoice->invoice_status === 'pending') value="pending">PENDING</option>
                                                    <option @selected($invoice->invoice_status === 'paid') value="paid">PAID</option>
                                                    <option @selected($invoice->invoice_status === 'partially_paid') value="partially_paid">PARTIALLY PAID</option>
                                                </select>
                                            </div>
                                            @error('invoice_status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <button type="submit" class="btn btn-info">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="container-fluid mt-5 w-100">
                <h2>Attachments</h2>
                <div class="row">
                    @foreach($invoice->attachments as $attachment)
                        <div class="col-md-3 mb-3">
                            @php
                                $isPdf = pathinfo($attachment->file_name, PATHINFO_EXTENSION) === 'pdf';
                                $fileUrl = asset($attachment->file_name);
                                $pdfIcon = asset('uploads/file_logo.png');
                            @endphp

                            @if($isPdf)
                                <a href="{{ $fileUrl }}" target="_blank">
                                    <img src="{{ $pdfIcon }}" class="img-thumbnail" alt="PDF File">
                                </a>
                            @else
                                <a href="{{ $fileUrl }}" target="_blank">
                                    <img src="{{ $fileUrl }}" class="img-thumbnail" alt="{{ $attachment->file_name }}">
                                </a>
                            @endif

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm mt-2 delete-attachment"
                                    data-attachment-id="{{ $attachment->id }}"
                                    data-invoice-id="{{ $invoice->id }}"
                                    data-attachment-name="{{ $attachment->file_name }}">
                                Delete
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>




            <!-- Print & Email Buttons -->
            <div class="container-fluid w-100">
                <a href="javascript:;" id="invoice_send_mail" class="btn btn-primary float-end mt-4 ms-2 d-print-none"
                    data-invoice-id="{{ $invoice->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-send me-3 icon-md">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>Send Invoice Details
                </a>

                <a id="print_button" href="javascript:;" class="btn btn-outline-primary float-end mt-4 d-print-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-printer me-2 icon-md">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

$(document).ready(function() {
    // Handle delete button click
    $('.delete-attachment').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var button = $(this);
        var attachmentId = button.data('attachment-id');
        var invoiceId = button.data('invoice-id');
        var attachmentName = button.data('attachment-name');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the attachment" ,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("attachments.delete", ["invoiceId" => ":invoiceId", "attachmentId" => ":attachmentId"]) }}'
                        .replace(':invoiceId', invoiceId)
                        .replace(':attachmentId', attachmentId),
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then(() => {
                            // Optionally, remove the deleted attachment from the DOM
                            button.closest('.col-md-3').remove();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
             // when you use it for another project , check bootstrap version
            $('#print_button').on('click', function() {
                let printContents = $('#print_card').html();
                let printWindow = window.open('', '', 'width=600,height=600');
                printWindow.document.open();
                printWindow.document.write('<html>');
                printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
                printWindow.document.write('<body>');
                printWindow.document.write(printContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            });
    </script>
@endpush
