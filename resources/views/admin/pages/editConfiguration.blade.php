  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Cấu hình</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Cấu hình</li>
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
                <h3 class="card-title">Cấu hình</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($configuration){{route('editConfiguration',['id'=>$configuration['id_configuration']])}}@endisset" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Giá trị</label>
                    @if($configuration['name']!='LOGO')
                    <div class="col-sm-10">
                      <input type="text" name="value" value="@isset($configuration['value']){{$configuration['value']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên Cấu hình">
                    </div>
                    @else
                    <div class="col-sm-10 row">
                          <div class="col-sm-6">
                            <input type="file" name="image">
                          </div>
                          @isset ($configuration)
                          <div class="col-sm-6">
                              <img src="{{ asset('upload/configuration/'.$configuration['value']) }}" width="150px">
                          </div>
                         
                          @endisset
                        </div>
                        @endif
                  </div> 
                  
                    </div>
        <div class="card-footer">
                  <a type="submit" class="btn btn-default" href="{{ route('adminConfiguration') }}">Thoát</a>
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