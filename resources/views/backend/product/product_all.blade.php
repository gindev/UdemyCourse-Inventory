@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Products All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col">
                                <h4 class="card-title">Products All Data</h4>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ route('product.add') }}" class="btn btn-primary waves-effect waves-light">Add Product</a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-auto">Name</th>
                                <th class="col-auto">Supplier Name</th>
                                <th class="col-auto">Unit</th>
                                <th class="col-auto">Category</th>
                                <th class="col-1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product['supplier']['name'] }}</td>
                                <td>{{ $product['unit']['name'] }}</td>
                                <td>{{ $product['category']['name'] }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger sm" title="Delete" id="delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
@endsection