@extends('admin.body.dashboard')
@section('title')
    Reports
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <form action="{{ route('search_reports_by_clients') }}" method="GET" role="search" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-lg-3" id="section">
                                <p class="mg-b-10">القسم</p>
                                <select class="form-control" id="section_select" name="section">
                                    @foreach ($sections as $item)
                                        <option value="{{ $item->id }}" {{ request()->input('section') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="type">
                                <p class="mg-b-10">المنتج</p>
                                <select class="form-control" id="product_select" name="products">
                                    <option value="">اختار المنتج</option>
                                    @foreach ($products as $id => $product_name)
                                        <option value="{{ $id }}" {{ request()->input('products') == $id ? 'selected' : '' }}>
                                            {{ $product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="start_at" value="{{ request()->input('start_at') }}" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">الي تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="end_at" value="{{ request()->input('end_at') }}" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-1">
                                <button type="submit" class="btn btn-primary btn-block">بحث</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($details) && $details->count())
                            <table id="example" class="table key-buttons text-md-nowrap" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                        <th class="border-bottom-0">المنتج</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">الخصم</th>
                                        <th class="border-bottom-0">نسبة الضريبة</th>
                                        <th class="border-bottom-0">قيمة الضريبة</th>
                                        <th class="border-bottom-0">الاجمالي</th>
                                        <th class="border-bottom-0">الحالة</th>
                                        <th class="border-bottom-0">عمليات</th> <!-- New column header -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($details as $invoice)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $invoice->invoice_number }} </td>
                                            <td>{{ $invoice->invoice_Date }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>{{ $invoice->product->product_name }}</td>
                                            <td>{{ $invoice->section->name }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->rate_vat }}</td>
                                            <td>{{ $invoice->value_vat }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>
                                                @if ($invoice->invoice_status == 'paid')
                                                    <span class="text-success">{{ $invoice->invoice_status }}</span>
                                                @elseif($invoice->invoice_status == 'pending')
                                                    <span class="text-danger">{{ $invoice->invoice_status }}</span>
                                                @else
                                                    <span class="text-warning">{{ $invoice->invoice_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('invoices_details', $invoice->id) }}" class="btn btn-inverse-warning m-2" title="عرض">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-inverse-primary m-2" title="تعديل">
                                                    <i class="bi bi-pen-fill"></i>
                                                </a>
                                                <a href="{{ route('delete_invoice', $invoice->id) }}" class="btn btn-inverse-danger m-2" id="delete" title="حذف">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No results found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
 $(document).ready(function() {
    $('#section_select').on('change', function() {
        const section_id = $(this).val();
        $.ajax({
            url: "{{ route('products_belongs_section') }}",
            type: 'GET',
            data: {
                section_id: section_id,
            },
            success: function(response) {
                const products = $('#product_select');
                products.empty();
                products.append('<option value="">اختار المنتج</option>');
                $.each(response, function(id, product_name) {
                    products.append('<option value="' + id + '">' + product_name + '</option>');
                });
                // Set previously selected product if available
                if ("{{ old('products') }}") {
                    products.val("{{ old('products') }}");
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    // Set previously selected section if available
    if ("{{ old('section') }}") {
        $('#section_select').val("{{ old('section') }}").trigger('change');
    }
});
</script>
@endpush
