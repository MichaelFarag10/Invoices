@extends('layouts.master')
@section('title')
الاقسام
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
							<h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاعدادات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row">

					@if(session()->has('Error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>{{session()->get('Error')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					@if(session()->has('Add'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('Add')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					@if(session()->has('deletesection'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('deletesection')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					

				<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									@can('اضافة قسم')
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-just-me" data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
									@endcan
								</div>
	
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" style="font-size: 12px; text-align:center;">
										<thead>
											<tr>
												<th  style="font-size: 12px;" class="border-bottom-0">#</th>
												<th  style="font-size: 12px;" class="border-bottom-0">اسم القسم</th>
												<th  style="font-size: 12px;" class="border-bottom-0">الملاحظات</th>
												<th  style="font-size: 12px;" class="border-bottom-0">العمليات</th>						
												
											</tr>
										</thead>
										<tbody>
											
											@foreach($data as $data)
											<?php $number = 0;?>
											<?php $number++?>
											<tr>
												<td>{{$number}}</td>
												<td>{{$data->section_name}}</td>
												<td>{{$data->discription}}</td>
												<td>{{$data->created_by}}</td>
												@can('تعديل قسم')
												<td><a class="btn btn-primary" href="{{url('updatesection')}}/{{$data->id}}">تعديل</a></td>
												@endcan
												@can('حذف قسم')
												<td> <a class="btn btn-danger " onclick="return confirm('Are you sure')" href="{{url('deletesection',$data->id)}}">حذف</a> </td>	
												@endcan
											</tr>
											@endforeach
										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="modal" id="modaldemo8">
					<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{url('addsections')}}" method="POST">
							@csrf
						<div class="form-group">
							<label for="exampleInputEmail">اسم القسم </label>
							<input type="text" class="form-control" id="section_name" name="section_name" required>	
						</div>

						<div class="form-group">
							<label for="exampleInputEmail">الملاحظات </label>
							<textarea type="text" class="form-control" id="discription" name="discription" rows="3" required></textarea>
						</div>

						<div class="modal_footer">
							<button type="submit" class="btn btn-success">تاكيد</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
						</div>
				</form>
				</div>
			</div>
		</div>

				</div>



			
		</div>




	   <!-- /////////////////////////////// -->
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