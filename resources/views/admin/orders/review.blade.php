@extends('layouts.admin')

@section('title', 'In Review Orders')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">In Review Orders</li>
                    </ol>
                </div>
                <h4 class="page-title">In Review Orders</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Order No</th>
                                    <th>Buyer</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->
@endsection
@section('js')
    <script>
        let data = [
            {data: 'date', name: 'date'},
            {data: 'order_no', name: 'order_no'},
            {data: 'buyer', name: 'buyer'},
            {data: 'product', name: 'product'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ];
        serverDT("{{ route('admin.order.review') }}", data);
    </script>
@endsection
