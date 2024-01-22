  @extends('admin.layout.layout')

  @section('content')

	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Đơn hàng</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Đơn hàng</li>
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
                  <h3 class="card-title col-lg-6">Danh sách đơn hàng</h3>
                  <div class="col-lg-6">
                  {{-- <div class="float-right">
                    <a class="btn btn-block btn-info" href="{{ route('addOrder') }}"><i class="fas fa-plus-circle"></i> Thêm nhà sản xuất mới</a>
                  </div> --}}
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 20px">Số hóa đơn</th>
                      <th>Tên khách hàng</th>
                      <th>Phương thức thanh toán</th>
                      <th>Tình trạng thanh toán</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Ngày đặt hàng</th>
                      <th style="width: 100px;text-align: center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order as $key=>$value)
                    <tr>
                      <td>{{$value['id_order']}}</td>
                      <td>{{$value['id_customer']}}</td>
                      <td>{!!$value['payment']!!}</td>
                      <td>{!!$value['check']!!}</td>
                      <td>{{number_format($value['total_price_tax'], 2)}} VND</td>
                      <td>{!!$value['status']!!}</td>
                      <td>{{date_format($value['created_at'],"H:i:s d/m/Y")}}</td>
                      <td>
                      	<div class="btn-group btn-group-sm">
                        <a href="{{ route('editOrder',['id'=>$value['id_order']]) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('deleteOrder',['id'=>$value['id_order']]) }}" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')"><i class="fas fa-trash"></i></a>
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
                  {{$order->links('pagination::bootstrap-4')}}
                </div>
              </div>
            </div>
            <!-- /.card -->
	    <!-- /.content -->



  @endsection
