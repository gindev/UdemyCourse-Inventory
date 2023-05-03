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
                            <h4 class="card-title">Edit Customer Page</h4>
                        </div>
                        <form id="myForm" method="post" action="{{ route('customer.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Customer Name</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $customer->name }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="customer_image" class="col-sm-2 col-form-label">Customer Image</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="file" name="customer_image" id="customer_image" value="">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="image_preview" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="customer_image_preview" src="{{ asset($customer->customer_image) }}" alt="No image selected">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="mobile_number" class="col-sm-2 col-form-label">Customer Mobile</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="mobile_number" value="{{ $customer->mobile_number }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Customer Email</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="email" name="email" value="{{ $customer->email }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Customer Address</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="address" value="{{ $customer->address }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Customer">
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
                    required: 'Please enter customer name',
                },
                mobile_number: {
                    required: 'Please enter customer mobile number',
                },
                email: {
                    required: 'Please enter customer email',
                },
                address: {
                    required: 'Please enter customer address',
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
    
    $(document).ready(function() {
        $('#customer_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#customer_image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection