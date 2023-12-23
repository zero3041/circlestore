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
                <h3 class="card-title">Giá trị</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($featureValue){{route('editValueFeature',['id'=>$featureValue['id_feature_value']])}}@endisset @empty($featureValue){{route('addValueFeature')}}@endempty" method="post">
                @csrf
                
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kiểu thuộc tính</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select class="custom-select" name="id_feature">
                          @isset ($feature)
                            @forelse ($feature as $arr)
                                <option value="{{$arr['id_feature']}}" @isset($featureValue){{$arr['id_feature']==$featureValue['id_feature']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset
                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Giá trị</label>
                    <div class="col-sm-10">
                      <input type="text" name="value" value="@isset($featureValue['value']){{$featureValue['value']}} @endisset" class="form-control" id="inputPassword3" placeholder="Giá trị của thuộc tính">
                    </div>
                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                	<a class="btn btn-default" onclick="return history.back();" href="#">Cancel</a>
                 	<button type="submit" class="btn btn-info float-right">Lưu</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection