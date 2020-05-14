@extends('admin.admin_layouts')
@section('admin_content')
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5> Orders Details</h5>
        </div><!-- sl-page-title -->

            <br>
            <h6 class="card-body-title">Orders List </h6>
            <table id="datatable1" class="table">
              <thead>
                <tr>
                    <th class="wd-15p text-center">SL</th>
                    <th class="wd-15p text-center">Payment Type</th>
                    <th class="wd-15p text-center">Transection ID</th>
                    <th class="wd-15p text-center">Quantity</th>
                    <th class="wd-15p text-center">Subtotal</th>
                    <th class="wd-20p text-center">Shipping</th>
                    <th class="wd-20p text-center">Vat</th>
                    <th class="wd-20p text-center">Total</th>
                    <th class="wd-20p text-center">Date</th>
                    <th class="wd-20p text-center">Status</th>
                    <th class="wd-20p text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $key => $row)
                <tr class="text-center">
                  <td>{{ $key+1 }}</td>
                  <td>{{ $row->payment_type }}</td>
                  <td>{{ $row->blnc_transection }}</td>
                  <td>{{ $row->quantity }}</td>
                  <td>${{ $row->subtotal }} </td>
                  <td>${{ $row->shipping_charge }} </td>
                  <td>${{ $row->vat }} </td>
                  <td>${{ $row->total }} </td>
                  <td>{{ $row->date }} </td>
                  <td>
                    @if($row->status == 0)
                     <span class="badge badge-warning">Pending</span>
                    @elseif($row->status == 1)
                    <span class="badge badge-info">Payment Accept</span>
                    @elseif($row->status == 2) 
                     <span class="badge badge-info">Progress </span>
                     @elseif($row->status == 3)  
                     <span class="badge badge-success">Delevered </span>
                     @else
                     <span class="badge badge-danger">Cancel </span>
                     @endif
              
                  <td>
                  	<a href="{{ route('order.view',$row->id) }}" class="btn btn-sm btn-info">View</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div><!-- sl-pagebody -->



@endsection