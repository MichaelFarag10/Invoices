@extends('layouts.master')
@section('title')
    ارشفة فاتورة
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">ارشيف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الفواتير</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
			@if(session()->has('delete'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>{{session()->get('delete')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					

					@if(session()->has('archive'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('archive')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					@if(session()->has('restore'))
					<script>
						window.onload = function(){
							notif({
								msg:"Invoice restore successfly",
								type:"success"
							})
						}	

					</script>
					
					@endif

					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="btn btn-primary" href="{{url('add_invoices')}}">Add Invoices</a>
								</div>
	
							</div>
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
												<th  style="font-size: 12px;" class="border-bottom-0">ID</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Invoice Number</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Invoice Date</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Due Date</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Product</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Section</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Discount</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Tax Rate</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Tax Value</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Total</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Status</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Notes</th>
												<th  style="font-size: 12px;" class="border-bottom-0">Oprations</th>
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
												<a href="{{url('invoices_details')}}/{{$invoices->id}}">{{$invoices->sectionm->section_name}}</a>							

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

													<td>
														<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" 
														data-toggle="dropdown" type="button">Oprations<i class="fas fa-caret-down ml-1"></i></button>
														<div class="dropdown-menu tx-13">	
															@can('حذف الفاتورة')											
															<a class="dropdown-item" onclick="return confirm('Are you sure?');" href="{{url('delete_invoice')}}/{{$invoices->id}}">Delete</a>
															@endcan

															<a class="dropdown-item" onclick="return confirm('Restore')" href="{{url('restore')}}/{{$invoices->id}}">Restore</a>
															</div>		
														</div>
													</td>
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
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection