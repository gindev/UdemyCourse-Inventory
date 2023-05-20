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
                            <h4 class="card-title">Add Product Page</h4>
                        </div>
                        <form id="myForm" method="post" action="{{ route('product.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="name" value="">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-10 form-group">
                                    <select class="form-select" aria-label="select supplier" name="supplier_id" id="supplier_id">
                                        <option value="">Please select a supplier</option>
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="unit_id" class="col-sm-2 col-form-label">Unit Name</label>
                                <div class="col-sm-10 form-group">
                                    <select class="form-select" aria-label="select unit" name="unit_id" id="unit_id">
                                        <option value="">Please select a unit</option>
                                        @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="category_id" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10 form-group">
                                    <select class="form-select" aria-label="select category" name="category_id" id="category_id">
                                        <option value="">Please select a category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
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
                supplier_id: {
                    required: true,
                },
                unit_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please enter product name',
                },
                supplier_id: {
                    required: 'Please select supplier',
                },
                unit_id: {
                    required: 'Please select unit',
                },
                category_id: {
                    required: 'Please select category',
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