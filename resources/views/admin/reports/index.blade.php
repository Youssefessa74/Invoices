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
                    <form action="{{ route('search_reports') }}" method="GET" role="search" autocomplete="off">
                        @csrf
                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input name="rdio" type="radio" class="form-check-input" value="1" id="type_div" {{ old('rdio') == '1' ? 'checked' : '' }}>
                                <span style="margin-left: 5px">بحث بنوع الفاتورة</span>
                            </label>
                        </div>

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input  name="rdio" id="search_with_invoice_number" class="form-check-input" value="2" type="radio" {{ old('rdio') == '2' ? 'checked' : '' }}>
                                <span style="margin-left: 5px">بحث برقم الفاتورة</span>
                            </label>
                        </div>
                        <br><br>

                        <div class="row">
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد نوع الفواتير</p>
                                <select class="form-control select2" name="type">
                                    <option value="">حدد نوع الفواتير</option>
                                    <option value="paid" {{ request()->input('type') == 'paid' ? 'selected' : '' }}>الفواتير المدفوعة</option>
                                    <option value="pending" {{ request()->input('type') == 'pending' ? 'selected' : '' }}>الفواتير الغير مدفوعة</option>
                                    <option value="partially_paid" {{ request()->input('type') == 'partially_paid' ? 'selected' : '' }}>الفواتير  المدفوعة جزئيا</option>
                                </select>
                            </div><!-- col-4 -->

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                <p class="mg-b-10">البحث برقم الفاتورة</p>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}">
                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="start_at" value="{{ old('start_at') }}" placeholder="YYYY-MM-DD" type="text">
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
                                    <input class="form-control fc-datepicker" name="end_at" value="{{ old('end_at') }}" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary btn-block">بحث</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($details))
                            <table id="example" class="table key-buttons text-md-nowrap" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ القاتورة</th>
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
                                                    <span class="text-success">PAID</span>
                                                @elseif($invoice->invoice_status == 'partially_paid')
                                                    <span class="text-warning">PARTIALLY PAID</span>
                                                @else
                                                    <span class="text-danger">PENDING</span>
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
            $('#invoice_number').hide();
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#type').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#type').hide();
                    $('#start_at').hide();
                    $('#end_at').hide();
                }
            });
        });





        window.addEventListener('beforeunload', function (e) {
        if (document.querySelector('form').checkValidity()) {
            // Customize your message here
            const confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';

            (e || window.event).returnValue = confirmationMessage; // For most browsers
            return confirmationMessage; // For others
        }
    });
    </script>
@endpush
