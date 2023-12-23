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
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	      <div class="card">
              <div class="card-header">
                <div class="row">
                  <h3 class="card-title col-lg-6">Danh sách các slide quảng cáo</h3>
                  <div class="col-lg-6">
                  <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addSlide') }}"><i class="fas fa-plus-circle"></i> Thêm slide mới</a>
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
                      <th style="width: 150px">Ảnh</th>
                      <th>Nội dung 1</th>
                      <th>Nội dung 2</th>
                      <th>Nội dung 3</th>
                      <th>Tình trạng</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($slide as $key=>$value)
                    <tr>
                      <td>{{$value['id']}}</td>
                      <td><img src="{{ asset($value['url']) }}" width="150px"></td>
                      <td>{{$value['text1']}}</td>
                      <td>{{$value['text2']}}</td>
                      <td>{{$value['text3']}}</td>
                      <td>{!!$value['active']!!}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('editSlide',['id'=>$value['id']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteSlide',['id'=>$value['id']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <div class="float-right">
                  {{$slide->links()}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->

	            
   
  @endsection