@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Unit All</h4>
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
                                <h4 class="card-title">Unit All Data</h4>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ route('unit.add') }}" class="btn btn-primary waves-effect waves-light">Add Unit</a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-auto">Name</th>
                                <th class="col-1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($units as $key => $unit)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>
                                    <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('unit.delete', $unit->id) }}" class="btn btn-danger sm" title="Delete" id="delete"><i class="fas fa-trash-alt"></i></a>
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