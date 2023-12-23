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
                <h3 class="card-title">Giá trị của thuộc tính</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($attrbuteValue){{route('editValueAttribute',['id'=>$attrbuteValue['id_attribute']])}}@endisset @empty($attrbuteValue){{route('addValueAttribute')}}@endempty" method="post">
                @csrf
                
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kiểu thuộc tính</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select class="custom-select" name="id_attribute_group">
                          @isset ($attrbuteGroup)
                            @forelse ($attrbuteGroup as $arr)
                                <option group="{{$arr['is_color']}}" value="{{$arr['id_attribute_group']}}" @isset($attrbuteValue){{$arr['id_attribute_group']==$attrbuteValue['id_attribute_group']?'selected':''}}@endisset>{{$arr['name']}}</option>
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
                      <input type="text" name="value" value="@isset($attrbuteValue['name']){{$attrbuteValue['name']}} @endisset" class="form-control" id="inputPassword3" placeholder="Giá trị của thuộc tính">
                    </div>
                  </div>
           
                  <div class="form-group row setcolor" @isset($attrbuteValue) @if($attrbuteValue['color']==null) style="display: none" @endif @endisset>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Màu sắc</label>
                    <div class="col-sm-10">
                      <input @isset($attrbuteValue) @if($attrbuteValue['color']==null)disabled=""@endif @endisset type="text" name="color" value="@isset($attrbuteValue['color']){{$attrbuteValue['color']}} @endisset" class="form-control jscolor" id="inputPassword3" placeholder="Giá trị của thuộc tính">
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