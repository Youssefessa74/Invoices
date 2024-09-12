@extends('admin.body.dashboard')
@section('title')
    Edit Invoices
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/vendors/dropify/dist/dropify.min.css">
    <div class="card">
        <div class="card-header">Invoices</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit An Invoice</h6>
                    <form method="POST" action="{{ route('invoices.update', $invoice->id) }}" class="forms-sample"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">رقم الفاتوره</label>
                                    <input type="text" name="invoice_number" value="{{ $invoice->invoice_number }}"
                                        class="form-control  @error('invoice_number') is-invalid @enderror"
                                        id="exampleInputUsername1" autocomplete="off" placeholder="invoice number">
                                </div>
                                @error('invoice_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="invoice_Date" class="form-label">تاريخ الفاتوره</label>
                                    <input type="date" name="invoice_Date" value="{{ $invoice->invoice_Date }}"
                                        class="form-control @error('invoice_Date') is-invalid @enderror" id="invoice_Date"
                                        autocomplete="off" placeholder="invoice Date">
                                </div>
                                @error('invoice_Date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">تاريخ الاستحقاق</label>
                                    <input type="date" name="due_date" value="{{ $invoice->due_date }}"
                                        class="form-control  @error('due_date') is-invalid @enderror"
                                        id="exampleInputUsername1" autocomplete="off" placeholder="due date">
                                </div>
                                @error('due_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sections" class="form-label">الاقسام</label>
                                    <select class="form-control @error('section') is-invalid @enderror" name="section"
                                        id="sections">
                                        <option selected disabled value="">Choose The Section</option>
                                        @foreach ($sections as $item)
                                            <option value="{{ $item->id }}" @selected($invoice->section->id == $item->id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="products" class="form-label">المنتجات</label>
                                    <select class="form-control @error('product') is-invalid @enderror" name="product"
                                        id="products">
                                        <option selected disabled value="">Choose The Product</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}" @selected($invoice->product_id == $item->id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">مبلغ التحصيل</label>
                                    <input type="text" name="Amount_collection"
                                        value="{{ $invoice->Amount_collection }}"
                                        class="form-control  @error('Amount_collection') is-invalid @enderror"
                                        id="exampleInputUsername1" autocomplete="off" placeholder="Amount collection">
                                </div>
                                @error('Amount_collection')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="amount_commission_id" class="form-label">مبلغ العموله</label>
                                    <input type="text" name="Amount_commission"
                                        value="{{ $invoice->Amount_commission }}" id="amount_commission_id"
                                        class="form-control @error('amount_commission') is-invalid @enderror"
                                        autocomplete="off" placeholder="amount commission">
                                </div>
                                @error('amount_commission')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="discount_id" class="form-label">الخصم</label>
                                    <input type="text" name="discount" id="discount_id"
                                        value="{{ $invoice->discount }}"
                                        class="form-control @error('discount') is-invalid @enderror" autocomplete="off"
                                        placeholder="discount">
                                </div>
                                @error('discount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="rate_vat_id" class="form-label">نسبه ضريبه القيمه المضافه</label>
                                    <select class="form-control @error('rate_vat') is-invalid @enderror" name="rate_vat"
                                        id="rate_vat_id">
                                        <option selected disabled value="">Choose The The Rate VAT</option>
                                        <option @selected($invoice->rate_vat == '5') value="5">5%</option>
                                        <option @selected($invoice->rate_vat == '10') value="10">10%</option>
                                    </select>
                                    @error('rate_vat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="value_vat_id" class="form-label">قيمه الضريبه المضافه</label>
                                    <input type="text" readonly name="value_vat" id="value_vat_id"
                                        class="form-control @error('value_vat') is-invalid @enderror" autocomplete="off"
                                        placeholder="value vat">
                                </div>
                                @error('value_vat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_id" class="form-label">االاجمالي شامل الضريبه</label>
                                    <input type="text" readonly name="total" id="total_id"
                                        class="form-control @error('total') is-invalid @enderror" autocomplete="off"
                                        placeholder="total">
                                </div>
                                @error('total')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="10" rows="10">{{ $invoice->description }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <div class="alert alert-success">صيغه المرفق pdf , jpg ,png ,jpeg</div>
                        </div>


                        <div class="mb-3">
                            <label for="file" class="form-label">ارفع ملف</label>
                            <input type="file" name="file_name" id="myDropify" class="dropify"
                                @if (isset($invoice->attachment) && $invoice->attachment->file_name)
                                    data-default-file="{{ asset($invoice->attachment->file_name) }}"
                                @endif
                            />
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/dropify.js"></script>
    <script src="{{ asset('backend') }}/assets/vendors/dropify/dist/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sections').on('change', function() {
                let section_id = $(this).val();
                let selectedProductId =
                    '{{ old('product', $invoice->product_id) }}'; // Get the existing product id

                $.ajax({
                    method: 'GET',
                    url: '{{ route('get_products') }}',
                    data: {
                        section_id: section_id
                    },
                    success: function(response) {
                        let productsDropdown = $('#products');
                        productsDropdown.empty(); // Clear existing options
                        productsDropdown.append(
                            '<option selected disabled value="">Choose The Product</option>'
                        );

                        $.each(response, function(id, product_name) {
                            let isSelected = id == selectedProductId ? ' selected' : '';
                            productsDropdown.append('<option value="' + id + '"' +
                                isSelected + '>' +
                                product_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching products:', error);
                    }
                });
            });

            // Trigger change event on page load if a section is pre-selected
            let preSelectedSection = $('#sections').val();
            if (preSelectedSection) {
                $('#sections').trigger('change');
            }
        });

        $(document).ready(function() {
            function calculateTotals() {
                var discount = parseFloat($('#discount_id').val()) || 0;
                var rate_vat = parseFloat($('#rate_vat_id').val()) || 0;
                var amount_commission = parseFloat($('#amount_commission_id').val()) || 0;

                // Validate if discount and amount_commission are numbers
                if (isNaN(discount) || isNaN(amount_commission)) {
                    alert('Please enter valid numeric values for Discount and Amount Commission.');
                    $('#value_vat_id').val('');
                    $('#total_id').val('');
                    return; // Exit the function to avoid further calculation
                }
                // Calculate the total amount after discount
                var amount_commission_total = amount_commission - discount;

                // Calculate VAT and total
                if (amount_commission_total > 0) {
                    var Result_1 = amount_commission_total * rate_vat / 100;
                    var Result_2 = amount_commission_total + Result_1;

                    // Update the fields with calculated values
                    $('#value_vat_id').val(Result_1.toFixed(2)); // Use .val() to set value
                    $('#total_id').val(Result_2.toFixed(2)); // Use .val() to set value
                } else {
                    alert('Amount Commission should be greater than the discount.');
                    $('#value_vat_id').val('');
                    $('#total_id').val('');
                }
            }

            // Attach event handlers
            $('#rate_vat_id').on('change', function() {
                // Filter out non-numeric input
                var value = $(this).val();
                if (isNaN(value) || value === '') {
                    $(this).val('');
                }

                calculateTotals();
            });
        });

        $(document).ready(function() {
            // Initialize Dropify
            $('.dropify').dropify();
        });
    </script>
@endpush
