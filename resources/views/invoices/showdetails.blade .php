@extends('layouts.master')
@section('title')
    تفاصيل فاتورة
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Mneu</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Invoices Mneu</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

			<!-- 		<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="btn btn-primary" href="{{url('add_invoices')}}">Add Invoices</a>
								</div>
	
							</div> -->
				<!-- row -->
				<div class="row">
			
				<!-- div -->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Bordered Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" text-align:center;>
										<thead>
											<tr>
												<th  style="font-size: 12px;" class="border-bottom-0">#</th>
												<th  style="font-size: 12px;" class="border-bottom-0">رقم الفاتورة</th>
												<th  style="font-size: 12px;" class="border-bottom-0">تاريخ الاصدار</th>
												<th  style="font-size: 12px;" class="border-bottom-0">تاريخ الاستحقاق</th>
												<th  style="font-size: 12px;" class="border-bottom-0">المنتج</th>
												<th  style="font-size: 12px;" class="border-bottom-0">القسم</th>
												<th  style="font-size: 12px;" class="border-bottom-0">نسبة الضريبة</th>
												<th  style="font-size: 12px;" class="border-bottom-0">قيمة الضريبة</th>
												<th  style="font-size: 12px;" class="border-bottom-0">المجموع</th>
												<th  style="font-size: 12px;" class="border-bottom-0">الحالة</th>
												<th  style="font-size: 12px;" class="border-bottom-0">الملاحظات</th>
												<th  style="font-size: 12px;" class="border-bottom-0">المرفقات</th>
												<th  style="font-size: 12px;" class="border-bottom-0">المستخدم</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Created At</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Updated At</th>
											</tr>
										</thead>
										<tbody>
											<?php $x=0;?>
											@foreach($invoices as $invoices)
											<tr>
												<?php $x++?>
												<td>{{$x}}</td>
												<td>{{$invoices->invoice_number}}</td>
												<td>{{$invoices->invoice_Date}}</td>
												<td>{{$invoices->Due_date}}</td>
												<td>{{$invoices->product}}</td>
												<td>
												<a href="{{url('invoices')}}/{{$invoices->id}}">{{$invoices->sectionm->section_name}}</a>							

												</td>
												<td>{{$invoices->Discount}}</td>
												<td>{{$invoices->Rate_VAT}}</td>
												<td>{{$invoices->Value_VAT}}</td>
												<td>{{$invoices->Total}}</td>
												<td>
													@if($invoices->Value_Status == 1)
														<span class="text-success">{{$invoices->Status}}</span>
													@elseif($invoices->Value_Status == 2)
													<span class="text-danger">{{$invoices->Status}}</span>
													@else
													<span class="text-warning">{{$invoices->Status}}</span>	
													@endif
												</td>
												<td>{{$invoices->note}}</td>
											
												@foreach($invoices_attach as $attach)
												
													<td><img style="height: 300px !important" src="/Attachments/{{$attach->file_name}}" alt=""></td>
													
												@endforeach
											
												@foreach($invoices_details as $details)
												
													<td>{{$details->user}}</td>
													<td>{{$details->created_at}}</td>
													<td>{{$details->updated_at}}</td>
												
												@endforeach
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
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection