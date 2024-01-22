  @extends('admin.layout.layout')

  @section('content')

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Thông số sản phẩm</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Thông số sản phẩm</li>
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
                  <h3 class="card-title col-lg-6">Danh sách thông số sản phẩm</h3>
                  <div class="col-lg-6">
                    <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addValueFeature') }}"><i class="fas fa-plus-circle"></i> Thêm mới giá trị</a>
                  </div>
                    <div class="float-right" style="padding-right: 10px;">
                    <a class="btn btn-block btn-info" href="{{ route('addFeature') }}"><i class="fas fa-plus-circle"></i> Thêm mới thông số</a>
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
                      <th>Thông số sản phẩm</th>
                      <th>Tổng các giá trị</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($feature as $key=>$value)
                    <tr>
                      <td>{{$value['id_feature']}}</td>
                      <td>{{$value['name']}}</td>
                      <td>{{$value['total']}}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('adminValueFeature',['id'=>$value['id_feature']]) }}" class="btn btn-block bg-gradient-secondary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('editFeature',['id'=>$value['id_feature']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteFeature',['id'=>$value['id_feature']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
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
              	 {{$feature->onEachSide(3)->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
