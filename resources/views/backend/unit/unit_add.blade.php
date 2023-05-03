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
                            <h4 class="card-title">Add Unit Page</h4>
                        </div>
                        <form id="myForm" method="post" action="{{ route('unit.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Unit Name</label>
                                <div class="col-sm-10 form-group">
                                    <input class="form-control" type="text" name="name" value="">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Unit">
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
            },
            messages: {
                name: {
                    required: 'Please enter unit name',
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