  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Thuộc tính</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Thuộc tính</li>
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
                <h3 class="card-title">Thuộc tính</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($attrbuteGroup){{route('editAttribute',['id'=>$attrbuteGroup['id_attribute_group']])}}@endisset @empty($attrbuteGroup){{route('addAttribute')}}@endempty" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($attrbuteGroup['name']){{$attrbuteGroup['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên thuộc tính">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kiểu thuộc tính</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select class="custom-select" name="type">
                          <option value="select" @isset($attrbuteGroup['group_type']){{$attrbuteGroup['group_type']=='select'?'selected':''}}@endisset>Danh sách lựa chọn</option>
                          <option value="radio" @isset($attrbuteGroup['group_type']){{$attrbuteGroup['group_type']=='radio'?'selected':''}}@endisset>Nút lựa chọn</option>
                          <option value="color" @isset($attrbuteGroup['group_type']){{$attrbuteGroup['group_type']=='color'?'selected':''}}@endisset>Màu sắc</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                	<a type="submit" class="btn btn-default" href="{{ route('adminAttribute') }}">Cancel</a>
                 	<button type="submit" class="btn btn-info float-right">Lưu</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection