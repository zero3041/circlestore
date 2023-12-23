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
          @if (session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
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
              <form class="form-horizontal" action="@isset($categories['id_category']){{route('editCategory',['id'=>$categories['id_category']])}}@endisset @empty($categories['id_category']){{route('addCategory')}}@endempty" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên danh mục</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="@isset($categories['name']){{$categories['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên danh mục">
                    </div>
                  </div>
{{--                  <div class="row form-group">--}}
{{--                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Ảnh</label>--}}
{{--                        <div class="col-sm-10 row">--}}
{{--                          <div class="col-sm-6">--}}
{{--                            <input type="file" name="image">--}}
{{--                          </div>--}}
{{--                          @isset ($categories)--}}
{{--                          <div class="col-sm-6">--}}
{{--                              <img src="{{ asset('upload/category/'.$categories['url']) }}" width="150px">--}}
{{--                          </div>--}}
{{--                          @endisset--}}
{{--                        </div>--}}
{{--                      </div>--}}
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hiển thị danh mục</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($categories['active']) checked="" @endisset>
                          <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Danh mục cha</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <ul id="treeview">
                          <li> <i class="fa fa-plus"></i>
                            <label>
                              <input type="radio" name="category" value="0_1" @isset($categories['id_category']) @if($categories['id_parent']==0) checked="" @endif @endisset />
                              Gốc </label>
                            <ul>
                              @isset($category)
                                  
                              
                              @foreach ($category['level1'] as $value1) 
                               <li> <i class="fa fa-plus"></i>
                                  <label>
                                    <input type="radio" name="category" value="{{$value1['id_category']}}_1" @isset($categories['id_category']) @if($categories['id_parent']==$value1['id_category']) checked="" @elseif($categories['id_category']==$value1['id_category']) disabled="" @endif @endisset />
                                    {{$value1['name']}} </label>

                                  @foreach ($category['level2'] as $value2)
                                  @if($value2['id_parent']==$value1['id_category'])
                                  <ul>
                                    <li> <i class="fa fa-plus"></i>
                                      <label>
                                    <input type="radio" name="category" value="{{$value2['id_category']}}_2" @isset($categories['id_category']) @if($categories['id_parent']==$value2['id_category']) checked="" @elseif($categories['id_category']==$value2['id_category']) disabled="" @endif @endisset/>
                                    {{$value2['name']}} </label>

                                     @foreach ($category['level3'] as $value3)
                                      @if($value3['id_parent']==$value2['id_category'])       
                                     <ul>
                                      <li> <i class="fa fa-plus"></i>
                                      <label>
                                        <input type="radio" name="category" value="{{$value3['id_category']}}_3" @isset($categories['id_category']) @if($categories['id_parent']==$value3['id_category']) checked="" @elseif($categories['id_category']==$value3['id_category']) disabled="" @endif @endisset/>
                                        {{$value3['name']}} </label>
                                     @foreach ($category['level4'] as $value4)
                                     @if($value3['id_parent']==$value2['id_category'])
                                     <ul>
                                      <li>
                                      <label><i class="fa fa-plus"></i> {{$value4['name']}} 
                                      </li>
                                    </ul>
                                    @endif
                                     @endforeach
                                    </li>
                                    </ul>
                                    @endif
                                    @endforeach

                                    </li>
                                  </ul>
                                  @endif
                                  @endforeach

                                </li>
                              
                              @endforeach
                             @endisset
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                	<a type="submit" class="btn btn-default" href="{{ route('adminCategory') }}">Cancel</a>
                 	<button type="submit" class="btn btn-info float-right">Lưu</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection