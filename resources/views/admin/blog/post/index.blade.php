@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Post Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Post List </h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p text-center">Post_Title</th>
                  <th class="wd-15p text-center">Category</th>
                  <th class="wd-15p text-center">Image</th>
                  <th class="wd-20p text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($post as $row)
                <tr class="text-center">
                  <td>{{ $row->post_title_en }}</td>
                  <td>{{ $row->category_name_en }}</td>
                  <td><img src="{{ URL::to($row->post_image) }}" height="50px;" width="50px;"></td>
                  <td>
                  	<a href="{{route('blog.post.edit',$row->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  	<a href="{{route('blog.post.destroy',$row->id)}}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                  </td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
  {{-- </div> --}}



@endsection