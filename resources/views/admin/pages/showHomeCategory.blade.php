  @extends('admin.layout.layout')

  @section('content')
      @csrf

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Tùy chọn danh mục</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Tùy chọn danh mục</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	      <div class="card">
              <div class="card-header">
                <div class="row">
                  <h3 class="card-title col-lg-6">Chọn danh mục sẽ hiển thị ở trang chủ</h3>
                  <div class="col-lg-6">
                  <div class="float-right">
                    {{-- <a class="btn btn-block btn-info" href="{{ route('addBanner') }}"><i class="fas fa-plus-circle"></i> Thêm banner mới</a> --}}
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
{{--                      <th style="width: 150px">Ảnh</th>--}}
                      <th>Tên danh mục</th>
                      <th>Hiển thị sản phẩm ở trang chủ</th>
                      <th>Tình trạng</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($category as $key=>$value)
                    <tr>
                      <td>{{$value['id_category']}}</td>
{{--                      <td><img src="{{ asset('upload/category/'.$value['url']) }}" width="150px"></td>--}}
                      <td>{{$value['name']}}</td>
                      <td>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch{{$key}}" name="show_home[]" value="1" @isset($value['show_home']){{$value['show_home']==1?'checked':''}}  @endisset>
                          <label class="custom-control-label" for="customSwitch{{$key}}" onclick="saveShowHomeCategory(this,{{$value['id_category']}});"></label>
                        </div>
                      </td>
                      <td>{!!$value['active']!!}</td>

                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="float-right">
                  {{$category->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
