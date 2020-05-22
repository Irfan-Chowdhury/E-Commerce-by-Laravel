@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Admin Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Sub-Admin List
                <a href="{{ route('sub-admin.create') }}" class="btn btn-sm btn-warning" style="float: right;" >Add New</a>
            </h6>
            <br>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                        <th class="wd-15p text-center">SL</th>
                        <th class="wd-15p text-center">Name</th>
                        <th class="wd-15p text-center">Phone</th>
                        <th class="wd-15p text-center">Access</th>
                        <th class="wd-20p text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $key => $row)
                            <tr class="text-center">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>
                                    @if($row->category == 1)
                                        <span class="p-2 badge badge-danger">Category</span>
                                    @endif 

                                    @if($row->coupon == 1)
                                        <span class="p-2 badge badge-success">Coupon</span>
                                    @endif 

                                    @if($row->product == 1)
                                        <span class="p-2 badge badge-info">Product</span>
                                    @endif 

                                    @if($row->blog == 1)
                                        <span class="p-2 badge badge-warning">Blog</span>
                                    @endif 

                                    @if($row->order == 1)
                                        <span class="p-2 badge badge-primary">Order</span>
                                    @endif

                                    @if($row->other == 1)
                                        <span class="p-2 badge badge-danger">Other</span>
                                    @endif

                                    @if($row->report == 1)
                                        <span class="p-2 badge badge-success">Report</span>
                                    @endif

                                    @if($row->stock == 1)
                                        <span class="p-2 badge badge-danger">Stock</span>
                                    @endif

                                    @if($row->role == 1)
                                        <span class="p-2 badge badge-info">Role</span>
                                    @endif

                                    @if($row->return == 1)
                                        <span class="p-2 badge badge-warning">Return</span>
                                    @endif

                                    @if($row->contact == 1)
                                        <span class="p-2 badge badge-primary">Contact</span>
                                    @endif

                                    @if($row->comment == 1)
                                        <span class="p-2 badge badge-danger">Comment</span>
                                    @endif

                                    @if($row->setting == 1)
                                        <span class="p-2 badge badge-success">Setting</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('sub-admin.edit',$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{route('sub-admin.delete',$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->



@endsection