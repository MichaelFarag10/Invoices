@extends('layouts.master')
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
							<h4 class="content-title mb-0 my-auto">تعديل المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاعدادات</span>
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

                    @if(session()->has('Update'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('Update')}}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif


                    @if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                        @foreach($errors as $error)
                        <li>
                        {{$error}}}
                        </li>
                        @endforeach
                    </ul>
					</div>
					@endif

	

				<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-just-me" data-toggle="modal" href="#modaldemo8">تعديل القسم</a>
								
								</div>
	
							</div>
							<div class="card-body">
						
					</div>
					<div class="modal" id="modaldemo8">
					<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">تعديل المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{url('editproduct')}}/{{$products->id}}" method="POST">
							@csrf
						<div class="form-group">
							<label for="exampleInputEmail">اسم المنتج </label>
							<input type="text" class="form-control" id="product_name" name="product_name" value="{{$products->product_name}}" required>	
						</div>
                        
                        <div class="form-group">
                            <select  name="section_id" class="custom-select" id="section_id" required>
                            <option value="">---اختر القسم---</option>
                            @foreach($data as $data)
                            <option value="{{$data->id}}">{{$data->section_name}}</option>
                            @endforeach

                            </select>

                        </div>

						<div class="form-group">
							<label for="exampleInputEmail">الملاحظات </label>
							<input type="text"  class="form-control" id="discription" name="description" rows="3" value="{{$products->description}}" required>
						</div>

						<div class="modal_footer">
							<button type="submit" class="btn btn-success">تاكيد</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                           <span><a class="btn btn-primary" href="{{url('/products')}}">رجوع</a></span>
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