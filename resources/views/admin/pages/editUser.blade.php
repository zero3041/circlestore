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
          @if($errors->any())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $err)
                <div class="">{{$err}}</div>
              @endforeach
            </div>
          @endif
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->
              <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tài khoản</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($user){{route('editUser',['id'=>$user['id']])}}@endisset @empty($user){{route('addUser')}}@endempty" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Họ tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($user['name']){{$user['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Họ tên" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" value="@isset($user['email']){{$user['email']}} @endisset" class="form-control" id="inputEmail3" placeholder="Email đăng nhập" @isset($user['email']) disabled="" @endisset required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" value="@isset($user['phone_number']){{$user['phone_number']}} @endisset" class="form-control" id="inputEmail3" placeholder="Số điện thoại">
                    </div>
                  </div>
                    @if (\Auth::user()->id_profile == 1)
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Quyền truy cập</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select class="custom-select" name="profile">
                          <option value="1" @isset($user['id_profile']){{$user['id_profile']=='1'?'selected':''}}@endisset>Quản trị</option>
                          <option value="0" @isset($user['id_profile']){{$user['id_profile']=='0'?'selected':''}}@endisset>Nhân viên</option>
                        </select>
                      </div>
                    </div>
                  </div>
                    @endif
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="@if(isset($user))Để trống nếu bạn không muốn đổi mật khẩu @else Mật khẩu
                      @endif">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Xác nhận mật khẩu</label>
                    <div class="col-sm-10">
                      <input type="password" name="password_confirm" class="form-control" id="inputEmail3" placeholder="@if(isset($user))Để trống nếu bạn không muốn đổi mật khẩu @else Nhập lại mật khẩu
                      @endif">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                	<a type="submit" class="btn btn-default" href="{{ route('adminUser') }}">Cancel</a>
                 	<button type="submit" class="btn btn-info float-right">Lưu</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection