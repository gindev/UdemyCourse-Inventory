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
                            <h4 class="card-title">Add Purchase Page</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="date" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control example-date-input" type="date" value="" id="date" name="date">
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="number" class="col-sm-3 col-form-label">Purchase #</label>
                                    <div class="col-sm-10">
                                        <input class="form-control example-date-input" type="text" value="" id="number" name="number">
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="supplier_id" class="col-sm-3 col-form-label">Supplier</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="select supplier" name="supplier_id" id="supplier_id">
                                            <option value="">Please make a selection</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="category_id" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="select category" name="category_id" id="category_id">
                                            <option value="">Please make a selection</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="product_id" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="select category" name="product_id" id="product_id">
                                            <option value="">Please make a selection</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="" class="col-sm-3 col-form-label">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <i class="btn btn-secondary waves-effect waves-light fas fa-plus-circle disabled" id="addRow">&nbsp;Add More</i>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="card-body">
                        <form id="myForm" name="myForm" method="POST" action="{{ route('purchase.store') }}">
                            @csrf
                            <input type="hidden" id="purchaseDate" name="purchDate" value="" readonly>
                            <input type="hidden" id="purchaseNumber" name="purchNumber" value="" readonly>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th class="col-1">PCG/KG</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th class="col-2">Total Price</th>
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addRowLocation">
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input class="form-control disabled" type="text" name="estimated_amount" id="estimated_amount" value="0" readonly>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" id="storeButton">Purchase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    // allow or disable the add new row button
    $(document).on('change', '#product_id', function(){
        let product_value = $('#product_id option:selected').val();
        if(product_value > 0){
            $('#addRow').removeClass('disabled');
        } else {
            $('#addRow').addClass('disabled');
        }
    });

    // Update total field based on updated row total
    $(document).on('change','input.purchase-total', function(){
        let total = 0;
        $('input.purchase-total').each(function(){
            total += parseInt($(this).val());
        });
        $('#estimated_amount').val(total).trigger('change');
    });

    // Update row total based on qty or price
    $(document).on('change keyup', '#unitCount, #unitPrice', function(){
        let row = $(this).closest("tr");
        let sum = row.find('#unitCount').val() * row.find('#unitPrice').val();
        row.find('input#purchaseTotal').val(sum).trigger('change');
    });

    // add new row to the table with products
    $(document).on('click', '#addRow', function(){
        let supplier = $('#supplier_id option:selected').val();
        let product = $('#product_id option:selected').val();
        let category = {
            'id' : $('#category_id option:selected').val(),
            'name' : $('#category_id option:selected').text(),
        };

        $.ajax({
            url: "{{ route('get-product') }}",
            type: "GET",
            data: {
                category_id:category['id'],
                supplier_id:supplier,
                product_id:product,
            },
            success: function(data) {
                let count = $('#addRowLocation tr').length + 1;
                let row = '<tr>';
                row += '<td>';
                row += '<input type="hidden" id="prodSupId" name="prodSupId[]" value="'+data.supplier_id+'" readonly>';
                row += '<input type="hidden" id="prodCatId" name="prodCatId[]" value="'+data.category_id+'" readonly>';
                row += '<input type="text" class="form-control" id="prodCatName" name="prodCatName[]" value="'+category['name']+'" readonly>';
                row += '</td>';
                row += '<td><input type="hidden" id="prodId" name="prodId[]" value="'+data.id+'" readonly><input type="text" class="form-control" id="prodName" name="prodName[]" value="'+data.name+'" readonly></td>';
                row += '<td><input type="number" class="form-control" id="unitCount" name="unitCount[]" value="0"></td>';
                row += '<td><input type="number" class="form-control" id="unitPrice" name="unitPrice[]" value="0"></td>';
                row += '<td><input type="text" class="form-control" id="purchaseDesc" name="purchaseDesc[]" value=""></td>';
                row += '<td><input type="text" class="form-control purchase-total" id="purchaseTotal" name="purchaseTotal[]" value="0" readonly></td>';
                row += '<td><i class="btn btn-danger waves-effect waves-light bi bi-trash" id="deleteRow"></i></td>';
                row += '</tr>';
                $('#addRowLocation').append(row);
            }
        });
    });

    // submits the form
    $(document).on('click', '#storeButton', function(){
        let date = $("#date").val();
        let purchaseNumber = $('#number').val();

        $('#purchaseDate').val(date);
        $('#purchaseNumber').val(purchaseNumber);
        $('#myForm').submit();
    });

    // remove selected row from table
    $(document).on('click', '#deleteRow', function(){
        let element = $(this).closest('tr');
        element.find('#purchaseTotal').val('0').trigger('change');
        element.remove();
    });
});

// Purchase data supplier, category and product selctions
$(function(){
    // supplier selector
    $(document).on('change', '#supplier_id', function(){
        $('#category_id').prop('selectedIndex', 0).trigger('change');
        $('#product_id').prop('selectedIndex', 0).trigger( 'change');
        var supplier_id = $(this).val();
        $.ajax({
            url: "{{ route('get-category') }}",
            type: "GET",
            data: {supplier_id:supplier_id},
            success: function(data) {
                var html = '<option value="">Please make a selection</option>';
                $.each(data, function(key, value) {
                    html += '<option value="'+value.category_id+'">'+value.category.name+'</option>'
                });

                $('#category_id').html(html);
            }
        })
    });

    // category selector
    $(document).on('change', '#category_id', function(){
        var category_id = $(this).val();
        $('#product_id').prop('selectedIndex', 0).trigger('change');
        $.ajax({
            url: "{{ route('get-product') }}",
            type: "GET",
            data: {
                category_id:category_id,
                supplier_id:$('#supplier_id').val(),
            },
            success: function(data) {
                var html = '<option value="">Please make a selection</option>';
                $.each(data, function(key, value) {
                    html += '<option value="'+value.id+'">'+value.name+'</option>'
                });

                $('#product_id').html(html);
            }
        })
    });
});
</script>
@endsection