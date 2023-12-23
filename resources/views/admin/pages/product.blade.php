  @extends('admin.layout.layout')
 
  @section('content')

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Sản phẩm</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Sản phẩm</li>
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
                  <h3 class="card-title col-lg-6">Danh sách sản phẩm</h3>
                  <div class="col-lg-6">
                    <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addProduct') }}"><i class="fas fa-plus-circle"></i> Thêm sản phẩm mới</a>
                  </div>
                    {{-- <div class="float-right" style="padding-right: 10px;">
                    <a class="btn btn-block btn-info" href="{{ route('addProduct') }}"><i class="fas fa-plus-circle"></i> Thêm mới thuộc tính</a>
                  </div> --}}
                  
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Hình ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng</th>
                      <th>Giá chưa thuế</th>
                      <th>Giá bao gồm thuế</th>
                      <th>Tình trạng</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product as $key=>$value)

                    <tr>
                      <td>{{$value['id_product']}}</td>
                      <td><img src="{{ asset('upload/product').'/'.$value['image'] }}" width="100px"></td>
                      <td>{{$value['name']}}</td>
                      <td>{{$value['quantity']}}</td>
                      <td>{{number_format($value['price'], 2)}} VND</td>
                      <td>{{number_format($value['price_tax'], 2)}} VND</td>
                      <td>{!!$value['active']!!}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('editProduct',['id'=>$value['id_product']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteProduct',['id'=>$value['id_product']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa sản phẩm này?')"><i class="fas fa-trash"></i></a>
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
              	 {{$product->onEachSide(3)->links()}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->

	            
   
  @endsection