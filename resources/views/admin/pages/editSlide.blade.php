  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Slide quảng cáo</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Slide quảng cáo</li>
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
                <h3 class="card-title">Slide quảng cáo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($slide){{route('editSlide',['id'=>$slide['id']])}}@endisset @empty($slide){{route('addSlide')}}@endempty" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung 1</label>
                    <div class="col-sm-10">
                      <input type="text" name="text1" value="@isset($slide['text1']){{$slide['text1']}} @endisset" class="form-control" id="inputEmail3" placeholder="Nội dung hiển thị với kích thước chữ vừa">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung 2 (chính)</label>
                    <div class="col-sm-10">
                      <input type="text" name="text2" value="@isset($slide['text2']){{$slide['text2']}} @endisset" class="form-control" id="inputEmail3" placeholder="Nội dung hiển thị với kích thước chữ lớn">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung 3</label>
                    <div class="col-sm-10">
                      <input type="text" name="text3" value="@isset($slide['text3']){{$slide['text3']}} @endisset" class="form-control" id="inputEmail3" placeholder="Nội dung hiển thị với kích thước chữ nhỏ">
                    </div>
                  </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hiển thị slide</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($slide['active']){{$slide['active']==1?'checked':''}}  @endisset>
                          <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                      </div>
                  </div> 
                      <div class="row form-group">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Ảnh</label>
                        <div class="col-sm-10 row">
                          <div class="col-sm-6">
                            <input type="file" name="image">
                          </div>
                          @isset ($slide)
                          <div class="col-sm-6">
                              <img src="{{ asset('upload/slide/'.$slide['url']) }}" width="150px">
                          </div>
                          @endisset
                        </div>
                      </div>
                    </div>
                  <div class="card-footer">
                  <a type="submit" class="btn btn-default" href="{{ route('adminSlide') }}">Thoát</a>
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