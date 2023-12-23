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
                <h3 class="card-title">Tài khoản khách hàng</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($customer){{route('adminEditCustomer',['id'=>$customer['id_customer']])}}@endisset @empty($customer){{route('addCustomer')}}@endempty" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Giới tính</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio1" name="gender" value="1" @isset($customer['is_gender']) {{$customer['is_gender']==1?'checked':''}} @endisset @empty($customer) checked @endempty>
                          <label for="customRadio1" class="custom-control-label">Nam</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" value="0" name="gender" @isset($customer['is_gender']) {{$customer['is_gender']==0?'checked':''}} @endisset>
                          <label for="customRadio2" class="custom-control-label">Nữ</label>
                        </div>
                      </div>
                      </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Họ tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($customer['name']){{$customer['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Họ" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputdate" class="col-sm-2 col-form-label">Ngày sinh</label>
                    <div class="col-sm-10">
                      <input type="text" name="birthday" value="@isset($customer['birthday']){{ date('d-m-Y', strtotime($customer['birthday'])) }} @endisset" class="form-control" id="inputdate" placeholder="Ngày sinh">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" value="@isset($customer['email']){{$customer['email']}} @endisset" class="form-control" id="inputEmail3" placeholder="Email đăng nhập" @isset($customer['email']) disabled="" @endisset required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                      <input type="text" name="phone" value="@isset($customer['phone_number']){{$customer['phone_number']}} @endisset" class="form-control" id="inputEmail3" placeholder="Số điện thoại" required="">
                    </div>
                  </div>
                    
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Đất nước</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select class="custom-select" name="country">
                          @forelse ($country as $value)
                          <option value="{{$value['id_country']}}" @isset($customer){{$customer['id_country']==$value['id_country']?'selected':''}}@endisset>{{$value['name']}}</option>
                        
                        @empty
                        @endforelse
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tỉnh (thành phố)</label>
                    <div class="col-sm-10">
                      <input type="text" name="city" value="@isset($customer['city']){{$customer['city']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tỉnh (thành phố)" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Quận (huyện)</label>
                    <div class="col-sm-10">
                      <input type="text" name="address1" value="@isset($customer['address1']){{$customer['address1']}} @endisset" class="form-control" id="inputEmail3" placeholder="Quận (huyện)" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phường (xã)</label>
                    <div class="col-sm-10">
                      <input type="text" name="address2" value="@isset($customer['address2']){{$customer['address2']}} @endisset" class="form-control" id="inputEmail3" placeholder="Phường (xã)" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputaddress" class="col-sm-2 col-form-label">Số nhà (xóm, thôn, tổ)</label>
                    <div class="col-sm-10">
                      <input type="text" name="address3" value="@isset($customer['address3']){{$customer['address3']}} @endisset" class="form-control" id="inputaddress" placeholder="Số nhà (xóm, thôn, tổ)" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="@if(isset($customer))Để trống nếu bạn không muốn đổi mật khẩu @else Mật khẩu
                      @endif">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Xác nhận mật khẩu</label>
                    <div class="col-sm-10">
                      <input type="password" name="password_confirm" class="form-control" id="inputEmail3" placeholder="@if(isset($customer))Để trống nếu bạn không muốn đổi mật khẩu @else Nhập lại mật khẩu
                      @endif">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tình trạng tài khoản</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($customer['active']) checked="" @endisset>
                          <label class="custom-control-label" for="customSwitch3">Kích hoạt</label>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                	<a type="submit" class="btn btn-default" href="{{ route('adminCustomer') }}">Cancel</a>
                 	<button type="submit" class="btn btn-info float-right">Lưu</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection