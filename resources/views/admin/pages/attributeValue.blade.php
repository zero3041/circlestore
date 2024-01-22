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
	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	      <div class="card">
              <div class="card-header">
                <div class="row">
                  <h3 class="card-title col-lg-6">Danh sách các thuộc tính</h3>
                  <div class="col-lg-6">
                  <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addValueAttribute') }}"><i class="fas fa-plus-circle"></i> Thêm mới giá trị</a>
                  </div>
                  <div class="float-right" style="padding-right: 10px;">
                    <a class="btn btn-block btn-secondary" href="{{ route('adminAttribute') }}"><i class="fa fa-arrow-circle-left"></i> Trở về danh sách</a>
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
                      <th>Tên thuộc tính</th>
                      <th>Giá trị thuộc tính</th>
                      @if($attrbuteGroup['group_type']=='color')
                      <th >Màu sắc</th>
                      @endif
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attrbuteValue as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$attrbuteGroup['name']}}</td>
                      <td>{{$value['name']}}</td>
                      @if($attrbuteGroup['group_type']=='color')
                      <td><div style="background-color: #{{$value['color']}};height: 30px;width: 30px;border: 1px solid #DEE2E6"></div></td>
                      @endif
                      <td>
                      	<div class="btn-group btn-group-sm">
                        {{-- <a href="#" class="btn btn-block bg-gradient-secondary"><i class="fas fa-eye"></i></a> --}}
                        <a href="{{ route('editValueAttribute',['id'=>$value['id_attribute']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteValueAttribute',['id'=>$value['id_attribute']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
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
                  {{$attrbuteValue->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
