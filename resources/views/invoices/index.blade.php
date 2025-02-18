@extends('layouts.master')
@section('title', 'قائمة الفواتير')
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        @if(session()->has('success'))
            <div class="alert alert-success show" role="alert">
                <p>{{session()->get('success')}}</p>
            </div>
        @endif
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                        <a href="{{route('invoices.create')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
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
                                <th class="border-bottom-0">ملاحظات</th>
                                @role('admin')
                                    <th class="border-bottom-0">العمليات</th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($invoices as $index=>$invoice)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $invoice->invoice_number }} </td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->product->name }}</td>
                                    <td>{{ $invoice->section->name }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    <td>{{ $invoice->rate_vat }}</td>
                                    <td>{{ $invoice->value_vat }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple {{$invoice->status ? 'btn-primary' : 'btn-danger'}} btn-sm" data-toggle="dropdown"
                                                    type="button">
                                                @if($invoice->status)
                                                    مدفوعه
                                                @else
                                                    غير مدفوعه
                                                @endif

                                                <i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <form action="{{route('invoices.change.status', $invoice)}}" method="post" class="d-inline-block dropdown-item">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{$invoice->status ? 'btn-danger' : 'btn-primary'}}">
                                                        @if($invoice->status)
                                                            تغيير الى غير مدفوعة
                                                        @else
                                                            تغيير الى مدفوعة
                                                        @endif
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $invoice->note }}</td>
                                    @role('admin')
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <div class="dropdown-item " >
                                                    <a class="btn btn-sm btn-primary"
                                                       href=" {{ route('invoices.edit', $invoice) }}">تعديل
                                                        الفاتورة</a>
                                                </div>

                                                <div class="dropdown-item " >
                                                    <a class="btn btn-sm btn-info"
                                                       href=" {{ route('invoices.print', $invoice) }}">طباعة
                                                        الفاتورة</a>
                                                </div>

                                                <form action="{{route('invoices.destroy', $invoice)}}" method="post" class="d-inline-block dropdown-item">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">أرشفة</button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
