  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Nhà vận chuyển</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Nhà vận chuyển</li>
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
                <h3 class="card-title">Nhà vận chuyển</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($carrier){{route('editCarrier',['id'=>$carrier['id_carrier']])}}@endisset @empty($carrier){{route('addCarrier')}}@endempty" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên nhà vận chuyển</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($carrier['name']){{$carrier['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên nhà vận chuyển">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Giá vận chuyển</label>
                    <div class="col-sm-10">
                      <input type="text" name="price" value="@isset($carrier['price']){{$carrier['price']}} @endisset" class="form-control" id="inputEmail3" placeholder="Để 0 nếu bạn muốn miễn phí vận chuyển">
                    </div>
                  </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hiển thị nhà vận chuyển</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($carrier['active']){{$carrier['active']==1?'checked':''}}  @endisset>
                          <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                      </div>
                  </div> 
                      <div class="row form-group">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10 row">
                          <div class="col-sm-6">
                            <input type="file" name="image">
                          </div>
                          @isset ($carrier)
                          <div class="col-sm-6">
                              <img src="{{ asset('upload/carrier/'.$carrier['url']) }}" width="150px">
                          </div>
                          @endisset
                        </div>
                      </div>
                    </div>
                  <div class="card-footer">
                  <a type="submit" class="btn btn-default" href="{{ route('adminCarrier') }}">Thoát</a>
                  <button type="submit" class="btn btn-info float-right">Lưu</button> 
                </div> 
                  </div>
                </div>
                <!-- /.card-body -->
                 
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection