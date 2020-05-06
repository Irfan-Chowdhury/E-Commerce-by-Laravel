@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Product Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Product List </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p text-center">SL</th>
                  <th class="wd-15p text-center">Product ID</th>
                  <th class="wd-15p text-center">Product Name</th>
                  <th class="wd-15p text-center">Image</th>
                  <th class="wd-15p text-center">Category </th>
                  <th class="wd-15p text-center">Brand</th>
                  <th class="wd-15p text-center">Quantity</th>
                  <th class="wd-15p text-center">Status</th>
                  <th class="wd-20p text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($product as $key => $row)
                <tr class=" text-center">
                  <td>{{ $key+1 }}</td>
                  <td>{{ $row->product_code }}</td>
                  <td>{{ $row->product_name }}</td>
                  <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>
                  <td>{{ $row->category_name }}</td>
                  <td>{{ $row->brand_name }}</td>
                  <td>{{ $row->product_quantity }}</td>
                  <td>
                  	@if($row->status == 1)
                  	  <span class="p-2 badge badge-success">Active</span>
                  	@else
                  	  <span class="p-2 badge badge-danger">Inactive</span>
                  	@endif
                  </td>
                  <td>
                    <a href="#" class="btn btn-sm btn-warning" title="View"><i class="fa fa-eye"></i></a>
                  	<a href="#" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="{{route('product.delete',$row->id)}}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash"></i></a>

                  	@if($row->status == 1)
                  		<a href="{{ route('product.inactive',$row->id) }}" class="btn btn-sm btn-secondary" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                  	@else
                  		<a href="{{ route('product.active',$row->id) }}" class="btn btn-sm btn-success" title="Active"><i class="fa fa-thumbs-up"></i></a>
                  	@endif
                  	
                  </td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
  </div>



@endsection