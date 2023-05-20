@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Purchase Pending</h4>
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
                                <h4 class="card-title">Purchase Pending Data</h4>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ route('purchase.add') }}" class="btn btn-primary waves-effect waves-light">Add Purchase</a>
                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-auto">Purchase #</th>
                                <th class="col-auto">Date</th>
                                <th class="col-auto">Supplier</th>
                                <th class="col-auto">Category</th>
                                <th class="col-auto">Qty</th>
                                <th class="col-auto">Product Name</th>
                                <th class="col-auto">Status</th>
                                <th class="col-1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $key => $purchase)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $purchase->number }}</td>
                                <td>{{ date('d-m-Y', strtotime($purchase->date)) }}</td>
                                <td>{{ $purchase['supplier']['name'] }}</td>
                                <td>{{ $purchase['category']['name'] }}</td>
                                <td>{{ $purchase->qty }}</td>
                                <td>{{ $purchase['product']['name'] }}</td>
                                @if($purchase->status == '1')
                                <td><span class="btn btn-success">Approved</span></td>
                                @else
                                <td><span class="btn btn-warning">Pending</span></td>
                                <td>
                                    <a href="{{ route('purchase.approve', $purchase->id) }}" class="btn btn-success sm" title="Approve" id="ApproveBtn"><i class="fas fa-check-circle"></i></a>
                                </td>
                                @endif
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