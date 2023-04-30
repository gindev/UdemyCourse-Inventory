@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h4 class="card-title">Edit Supplier Page</h4>
                        </div>
                        <form id="myForm" method="post" action="{{ route('supplier.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $supplier->id }}">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $supplier->name }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="mobile_number" class="col-sm-2 col-form-label">Supplier Mobile</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="mobile_number" value="{{ $supplier->mobile_number }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Supplier Email</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="email" name="email" value="{{ $supplier->email }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Supplier Address</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="address" value="{{ $supplier->address }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Supplier">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                mobile_number: {
                    required: true,
                },
                email: {
                    required: true,
                },
                address: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please enter your name',
                },
                mobile_number: {
                    required: 'Please enter your mobile number',
                },
                email: {
                    required: 'Please enter your email',
                },
                address: {
                    required: 'Please enter your address',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection