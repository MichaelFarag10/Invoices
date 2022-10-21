@extends('layouts.master')
@section('title')
    تعديل فاتورة
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
							<h4 class="content-title mb-0 my-auto">Add Invoice</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoices</span>
						</div>
					</div>
				
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

	
					@if(session()->has('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>{{session()->get('error')}}</strong>
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

					@if(session()->has('DeleteProduct'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{session()->get('DeleteProduct')}}</strong>
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
				<!-- row -->
                <div class="row">

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <form action="{{url('updateinvoices',$invoices->id)}}" method="post" enctype="multipart/form-data"
                autocomplete="off">
                 @csrf

                <div class="row">
                    <div class="col">
                        <label for="inputName" class="control-label">Invoices Number</label>
                        <input type="text" class="form-control" id="inputName" name="invoice_number"
                            title="Enter Invoices Number" value="{{$invoices->invoice_number}}" required>
                    </div>

                    <div class="col">
                        <label>Invoices Date</label>
                        <input class="form-control fc-datepicker"  name="invoice_date" placeholder="YYYY-MM-DD"
                            type="text" value="{{$invoices->invoice_Date}}" required>
                    </div>

                    <div class="col">
                        <label>Due Date</label>
                        <input class="form-control fc-datepicker"  name="due_date" placeholder="YYYY-MM-DD"
                            type="text" value="{{$invoices->Due_date}}" required>
                    </div>

                </div>

                {{-- 2 --}}
                <div class="row">
                    <div class="col">
                        <label for="inputName" class="control-label">Section</label>
                        <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())"
                            onchange="console.log('change is firing')" required>
                            <!--placeholder-->
                            <option value="{{ $invoices->sectionm->id }}" selected disabled>{{ $invoices->sectionm->section_name }}</option>
                            @foreach ($section as $section)
                                <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Products</label>
                        <select id="product" name="product" class="form-control" required>
                        </select>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Aumount Collection</label>
                        <input type="text" class="form-control" id="inputName" name="amount_collection"
                             value="{{ $invoices-> Amount_collection }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                    </div>
                </div>


                {{-- 3 --}}

                <div class="row">

                    <div class="col">
                        <label for="inputName" class="control-label">Amount Commission</label>
                        <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                            name="amount_commission" title="Enter Amount Commission "
                            value="{{ $invoices-> Amount_Commission }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Discount</label>
                        <input type="text" class="form-control form-control-lg" id="Discount" name="discount"
                            title="Enter A Discount"
                            value="{{ $invoices-> Discount }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            value=0 required>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Rate VAT</label>
                        <select name="rate_vat"  id="Rate_VAT" class="form-control" onchange="myFunction()">
                            <!--placeholder-->
                            <option value="" selected disabled>{{$invoices->Rate_VAT}}</option>
                            <option value=" 5%">5%</option>
                            <option value="10%">10%</option>
                        </select>
                    </div>

                </div>

                {{-- 4 --}}

                <div class="row">
                    <div class="col">
                        <label for="inputName" class="control-label">Value VAT</label>
                        <input type="text" class="form-control" id="Value_VAT" name="value_vat" value="{{$invoices->Value_VAT}}" readonly>
                    </div>

                    <div class="col">
                        <label for="inputName" class="control-label">Total</label>
                        <input type="text" class="form-control" id="Total" name="total" value="{{$invoices->Total}}" readonly>
                    </div>
                </div>

                {{-- 5 --}}
                <div class="row">
                    <div class="col">
                        <label for="exampleTextarea">Notes</label>
                        <textarea class="form-control" id="exampleTextarea" name="note" required rows="3"></textarea>
                    </div>
                </div><br>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Data Save</button>
                </div>


            </form>
    
        </div>
    </div>
</div>
</div>

</div>

<!-- row closed -->
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




<script>
$(document).ready(function(){
    $('select[name="section"]').on('change',function(){
        var SectionId = $(this).val();
        if(SectionId){
            $.ajax({
                url:"{{URL::to('section')}}/" + SectionId,
                type:"GET",
                dataType:"json",
                success:function(data){
                    $('select[name="product"]').empty();
                    $.each(data,function(key,value){
                        $('select[name="product"]').append('<option value="'+ value + '">' + value + '</option>')
                    });
                }, 
            });
        }else{
            console.log('AJAX load did not work');
        }


    });
});


     function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('Enter Value Vat ');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
          
            }
        } 


    </script>

    
@endsection