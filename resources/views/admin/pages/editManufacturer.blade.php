  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Nhà sản xuất</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Nhà sản xuất</li>
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
                <h3 class="card-title">Nhà sản xuất</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($manufacturer){{route('editManufacturer',['id'=>$manufacturer['id_manufacturer']])}}@endisset @empty($manufacturer){{route('addManufacturer')}}@endempty" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên nhà sản xuất</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($manufacturer['name']){{$manufacturer['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên Nhà sản xuất">
                    </div>
                  </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hiển thị nhà sản xuất</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($manufacturer['active']){{$manufacturer['active']==1?'checked':''}}  @endisset>
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
                          @isset ($manufacturer)
                          <div class="col-sm-6">
                              <img src="{{ asset('upload/manufacturer/'.$manufacturer['url']) }}" width="150px">
                          </div>
                          @endisset
                        </div>
                      </div>
                    </div>
        <div class="card-footer">
                  <a type="submit" class="btn btn-default" href="{{ route('adminManufacturer') }}">Thoát</a>
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