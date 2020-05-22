@extends('admin.admin_layouts')
@section('admin_content')
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5> Orders Details</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Orders List </h6>
            <br>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p text-center">Payment Type</th>
                            <th class="wd-15p text-center">Transection ID</th>
                            <th class="wd-15p text-center">Subtotal</th>
                            <th class="wd-20p text-center">Shipping</th>
                            <th class="wd-20p text-center">Vat</th>
                            <th class="wd-20p text-center">Total</th>
                            <th class="wd-20p text-center">Date</th>
                            <th class="wd-20p text-center">Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $row)
                        <tr class="text-center">
                            <td>{{ $row->payment_type }}</td>
                            <td>{{ $row->blnc_transection }}</td>
                            <td>$ {{ $row->subtotal }}</td>
                            <td>$ {{ $row->shipping_charge }}</td>
                            <td>$ {{ $row->vat }}</td>
                            <td>$ {{ $row->total }}</td>
                            <td>{{ $row->date }} </td>
                            <td>
                                @if($row->return_order == 2)
                                    <span class="p-2 badge badge-success">Success</span>
                                @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->



    @endsection