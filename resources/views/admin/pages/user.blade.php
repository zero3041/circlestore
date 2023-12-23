  @extends('admin.layout.layout')
 
  @section('content')

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Tài khoản</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Tài khoản</li>
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
                  <h3 class="card-title col-lg-6">Danh sách tài khoản quản trị</h3>
                  <div class="col-lg-6">
                    <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addUser') }}"><i class="fas fa-plus-circle"></i> Thêm tài khoản mới</a>
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
                      <th>Tên</th>
                      <th>Email</th>
                      {{-- <th>Trang mặc định</th> --}}
                      <th>Quyền</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user as $key=>$value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td>{{$value['name']}}</td>
                      <td>{{$value['email']}}</td>
                      <td>{{$value['id_profile']}}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        {{-- <a href="{{ route('adminUser',['id'=>$value['id']]) }}" class="btn btn-block bg-gradient-secondary"><i class="fas fa-eye"></i></a> --}}
                        <a href="{{ route('editUser',['id'=>$value['id']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteUser',['id'=>$value['id']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
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
              	 {{$user->onEachSide(3)->links()}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->

	            
   
  @endsection