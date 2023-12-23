  @extends('admin.layout.auth')
 
  @section('content')
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Bạn quên mật khẩu? Tại đây bạn có thể dễ dàng lấy lại một mật khẩu mới.</p>
      @if($errors->any())
        <div class="login-box-msg">
          @foreach ($errors->all() as $err)
            <div class="login-box-msg" style="color:#C82333">{{$err}}</div>
          @endforeach
        </div>
      @endif
      <form action="{{ route('adminForgotPassword') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Khôi phục mật khẩu</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('adminlogin') }}">Đăng nhập</a>
      </p>
      <!--<p class="mb-0">-->
      <!--  <a href="{{ route('adminRegister') }}" class="text-center">Tạo tài khoản mới</a>-->
      <!--</p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
    @endsection
