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
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	      <div class="card">
              <div class="card-header">
                <div class="row">
                  <h3 class="card-title col-lg-6">Danh sách các cấu hình</h3>
                  <div class="col-lg-6">
                  <div class="float-right">
                    {{-- <a class="btn btn-block btn-info" href="{{ route('addConfiguration') }}"><i class="fas fa-plus-circle"></i> Thêm nhà sản xuất mới</a> --}}
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tên cấu hình</th>
                      <th>Giá trị</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($configuration as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value['public_name']}}</td>
                      <td>@if($value['name']=='LOGO') <img src="{{ asset('upload/configuration/home/'.$value['value']) }}" width="150px"> @else {{$value['value']}}  @endif</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('editConfiguration',['id'=>$value['id_configuration']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
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
                  {{$configuration->links()}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->

	            
   
  @endsection