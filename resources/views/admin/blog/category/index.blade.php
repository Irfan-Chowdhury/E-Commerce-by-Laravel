@extends('admin.admin_layouts')
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
          <div class="sl-page-title">
            <h5>Post's Category Table</h5>
          </div><!-- sl-page-title -->
  
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title mb-5">Post's Category List
                <a href="#" class="btn btn-sm btn-primary" style="float:right" data-toggle="modal" data-target="#modaldemo3">Add New</a>
            </h6>  
            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-15p text-center">ID</th>
                    <th class="wd-15p text-center">Category English</th>
                    <th class="wd-15p text-center">Category Bangla</th>
                    <th class="wd-20p text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($PostCategories as $row)
                  <tr class=" text-center">
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->category_name_en }}</td>
                    <td>{{ $row->category_name_bn }}</td>
                    <td>
                        <a href="{{route('blog.category.edit',$row->id)}}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{route('blog.category.destroy',$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card --> 
      </div><!-- sl-pagebody -->

<!--modal-->
    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <form method="post" action="{{route('blog.category.store')}}">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="exampleInputEmail1">Category English</label>
              <input type="text" name="category_name_en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category English">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Category Bangla</label>
              <input type="text" name="category_name_bn" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Bangla">
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
      </div><!-- modal-dialog -->
    </div>
  <!--/ modal -->
  
@endsection