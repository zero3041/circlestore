  @extends('admin.layout.layout')

  @section('content')
    @csrf

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Bài viết</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Bài viết</li>
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
                  <h3 class="card-title col-lg-6">Danh sách các bài viết</h3>
                  <div class="col-lg-6">
                  <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addPage') }}"><i class="fas fa-plus-circle"></i> Thêm bài viết mới</a>
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
                      <th>Tiêu đề</th>
                      <th>Hiển tiêu đề bài viết ở dưới cùng trang chủ</th>
                      <th>Tình trạng</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($page as $key=>$value)
                    <tr>
                      <td>{{$value['id_cms']}}</td>
                      <td>{{$value['title']}}</td>
                      <td>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch{{$key}}" name="show_home[]" value="1" @isset($value['show_home']){{$value['show_home']==1?'checked':''}}  @endisset>
                          <label class="custom-control-label" for="customSwitch{{$key}}" onclick="saveShowHomePage(this,{{$value['id_cms']}});"></label>
                        </div>
                      </td>
                      <td>{!!$value['active']!!}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('editPage',['id'=>$value['id_cms']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deletePage',['id'=>$value['id_cms']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
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
                  {{$page->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
