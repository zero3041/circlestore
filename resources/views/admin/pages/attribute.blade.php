  @extends('admin.layout.layout')

  @section('content')

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Thuộc tính</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Thuộc tính</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	      <div class="card">
              <div class="card-header">
                <div class="row">
                  <h3 class="card-title col-lg-6">Danh sách các thuộc tính</h3>
                  <div class="col-lg-6">
                    <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addValueAttribute') }}"><i class="fas fa-plus-circle"></i> Thêm mới giá trị</a>
                  </div>
                    <div class="float-right" style="padding-right: 10px;">
                    <a class="btn btn-block btn-info" href="{{ route('addAttribute') }}"><i class="fas fa-plus-circle"></i> Thêm mới thuộc tính</a>
                  </div>

                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Tên thuộc tính</th>
                      <th>Kiểu thuộc tính</th>
                      <th>Tổng các giá trị</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attrbuteGroup as $key=>$attr)
                    <tr>
                      <td>{{$attr['id_attribute_group']}}</td>
                      <td>{{$attr['name']}}</td>
                      <td>{{$attr['group_type']}}</td>
                      <td>{{$attr['total']}}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('adminValueAttribute',['id'=>$attr['id_attribute_group']]) }}" class="btn btn-block bg-gradient-secondary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('editAttribute',['id'=>$attr['id_attribute_group']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteAttribute',['id'=>$attr['id_attribute_group']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
                      </div>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="float-right">
              	 {{$attrbuteGroup->onEachSide(3)->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
