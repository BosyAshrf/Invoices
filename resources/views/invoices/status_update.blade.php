@extends('layouts.master')
@section('title')
تغيير حالة الدفع
@endsection
@section('css')
    <!-- Internal Data table css -->
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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تغيير حالة الدفع</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('Status_Update',$invoices->id)}}" method="post" autocomplete="off">
                                    {{ csrf_field() }}
                                    {{-- 1 --}}
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">رقم الفاتورة</label>
                                            <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                            <input type="text" class="form-control" id="inputName" name="invoice_number"
                                                title="يرجي ادخال رقم الفاتورة" value="{{ $invoices->invoice_number }}" required
                                                readonly>
                                        </div>
            
                                        <div class="col">
                                            <label>تاريخ الفاتورة</label>
                                            <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                                type="text" value="{{ $invoices->invoice_Date }}" required readonly>
                                        </div>
            
                                        <div class="col">
                                            <label>تاريخ الاستحقاق</label>
                                            <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                                type="text" value="{{ $invoices->Due_date }}" required readonly>
                                        </div>
            
                                    </div>
            
                                    {{-- 2 --}}
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">القسم</label>
                                            <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                                onchange="console.log('change is firing')" readonly>
                                                <!--placeholder-->
                                                <option value=" {{ $invoices->sections->id }}">
                                                    {{ $invoices->sections->section_name }}
                                                </option>
            
                                            </select>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">المنتج</label>
                                            <select id="product" name="product" class="form-control" readonly>
                                                <option value="{{ $invoices->product }}"> {{ $invoices->product }}</option>
                                            </select>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                            <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value="{{ $invoices->Amount_collection }}" readonly>
                                        </div>
                                    </div>
            
            
                                    {{-- 3 --}}
            
                                    <div class="row">
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">مبلغ العمولة</label>
                                            <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value="{{ $invoices->Amount_Commission }}" required readonly>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">الخصم</label>
                                            <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value="{{ $invoices->Discount }}" required readonly>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                            <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                                <!--placeholder-->
                                                <option value=" {{ $invoices->Rate_VAT }}">
                                                    {{ $invoices->Rate_VAT }}
                                            </select>
                                        </div>
            
                                    </div>
            
                                    {{-- 4 --}}
            
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                            <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                                value="{{ $invoices->Value_VAT }}" readonly>
                                        </div>
            
                                        <div class="col">
                                            <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                            <input type="text" class="form-control" id="Total" name="Total" readonly
                                                value="{{ $invoices->Total }}">
                                        </div>
                                    </div>
            
                                    {{-- 5 --}}
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">ملاحظات</label>
                                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                            {{ $invoices->note }}</textarea>
                                        </div>
                                    </div><br>
            
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">حالة الدفع</label>
                                            <select class="form-control" id="Status" name="status" required>
                                                <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                                <option value="مدفوعة">مدفوعة</option>
                                                <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                            </select>
                                        </div>
            
                                        <div class="col">
                                            <label>تاريخ الدفع</label>
                                            <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                                type="date" required>
                                        </div>
            
            
                                    </div><br>
            
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                                    </div>
            
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
                </div>
                <!-- Container closed -->
                </div>
                <!-- main-content closed -->
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