   @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Chi tiết đơn hàng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
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
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->   
    <!-- Main content -->
    <section class="content">
      <form class="form-horizontal" action="@isset($order){{route('editOrder',['id'=>$order['id_order']])}} @endisset" method="post">
        @csrf
        
      <div class="row">
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Thông tin khách hàng</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Tên khách hàng</label>
                <input type="text" id="inputName" class="form-control" value="@isset($order){{$order->id_customer}}@endisset" name="name" disabled="">
              </div>
              <div class="form-group">
                <label for="inputDescription">Địa chỉ nhận hàng</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="address">@isset($order){{$order->address}}@endisset
                </textarea>
              </div>

              <div class="form-group">
                <label for="inputClientCompany">Số điện thoại</label>
                <input type="text" id="inputClientCompany" class="form-control" value="@isset($order){{$order->phone_number}}@endisset" name="phone">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Ghi chú đơn hàng</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="note"></textarea>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Trạng thái thanh toán</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label for="inputStatus">Tình trạng thanh toán</label>
                <select class="form-control custom-select" name="check">
                  <option value="0" @isset($order){{$order->check==0?'selected':''}}@endisset>Chưa thanh toán</option>
                  <option value="1" @isset($order){{$order->check==1?'selected':''}}@endisset>Chờ thanh toán</option>
                  <option value="2" @isset($order){{$order->check==2?'selected':''}}@endisset>Đã thanh toán</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Phương thức thanh toán</label>
                <select class="form-control custom-select" name="payment">
                  <option value="0" @isset($order){{$order->payment==0?'selected':''}}@endisset>Nhận hàng thanh toán</option>
                  <option value="1" @isset($order){{$order->payment==1?'selected':''}}@endisset>Thanh toán online</option>
                  <!--<option value="2" @isset($order){{$order->payment==2?'selected':''}}@endisset>Qua thẻ ATM</option>-->
                </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Nhà vận chuyển</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputStatus">Trạng thái đơn hàng</label>
                <select class="form-control custom-select" name="status" @isset($order){{$order->status==0?'disabled':''}}@endisset>
                  <option value="0" @isset($order){{$order->status==0?'selected':''}}@endisset>Đã hủy</option>
                  <option value="1" @isset($order){{$order->status==1?'selected':''}}@endisset>Chờ xác nhận</option>
                  <option value="2" @isset($order){{$order->status==2?'selected':''}}@endisset>Đã xác nhận</option>
                  <option value="3" @isset($order){{$order->status==3?'selected':''}}@endisset>Đang giao hàng</option>
                  <option value="4" @isset($order){{$order->status==4?'selected':''}}@endisset>Giao hàng thành công</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputEstimatedBudget">Mã vận chuyển</label>
                <input type="number" id="inputEstimatedBudget" class="form-control" value="@isset($order){{$order->tracking_number}}@endisset" step="1" name="tracking_number">
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Nhà vận chuyển</label>
                <input type="text" id="inputSpentBudget" class="form-control" value="@isset($order){{$order->id_carrier}}@endisset" step="1" disabled="" name="carrier">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Sản phẩm</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
              <table class="table table-bordered table-reponsive">
                <thead>
                  <tr>
                    <th width="150px">ID sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng mua</th>
                    <th>Số lượng còn</th>
                    <th>Giá sản phẩm</th>
                    <th>Tổng cộng</th>
                  </tr>
                </thead>
                <tbody>
                  @isset ($orderDetail)
                    @foreach ($orderDetail as $value)
                      <tr>
                        <td>{{$value->id_product}}<input type="hidden" name="product[]" value="{{$value->id_product}}"></td>
                        <td><img src="{{ asset('upload/product/'.$value->image) }}" width="100px"></td>
                        <td>{{$value->product_name}}</td>
                        <td width="150px"><input type="text" name="product_quantity[]" value="{{$value->product_quantity}}" class="form-control"></td>
                        <td>{{$value->quantity}}</td>
                        <td>{{number_format($value->price, 2)}} VND</td>
                        <td>{{number_format($value->total_price_product, 2)}} VND</td>
                      </tr>
                    @endforeach  
                  @endisset
                </tbody>
              </table>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
            <div class="row">
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Hóa đơn</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Lưu ý</h5>
                  Nếu bạn đã sửa hóa đơn thì phải cập nhật hóa đơn rồi mới in hoặc xuất hóa đơn. 
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Xem hóa đơn</button>
                </div>
                <div class="col-sm-4">
                  <button type="button" id="print-invoice" class="btn btn-block btn-secondary">In hóa đơn</button>
                </div>
              <div class="col-sm-4">
                  <a type="button" class="btn btn-block btn-secondary" href="{{ route('pdf',['id'=>$order['id_order']]) }}">Xuất hóa đơn file PDF</a>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Tổng thanh toán của khách hàng</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Tổng tiền</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="@isset($order){{number_format($order->total_price, 2)}} @endisset VND" class="form-control" id="inputEmail3" disabled="" name="totalPrice">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Giá vận chuyển</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="@isset($order){{$order->total_shipping==0?'Miễn phí':number_format($order->total_shipping, 2).' VND'}}@endisset" class="form-control" id="inputEmail3" disabled="" name="total_shipping">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Tổng thanh toán</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" value="@isset($order){{number_format($order->total_price_tax, 2)}}@endisset VND" class="form-control" id="inputEmail3" disabled="" name="totalPrice_tax">
                  </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>

          <!-- /.card -->
        </div>
      </div>
      <div class="row" style="padding-bottom: 20px">
        <div class="col-12">
          <a href="{{ route('adminOrder') }}" class="btn btn-default">Thoát</a>
          <input type="submit" value="Cập nhật" class="btn btn-success float-right" @isset($order){{$order->status==0?'disabled':''}}@endisset>
        </div>
      </div>
</form>
    </section>
    <!-- /.content -->
    


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="invoice">

    <div class="toolbar hidden-print">

  
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="{{ asset('/') }}">
                            <img src="@isset ($shopValue['logo']) 
          {{ asset('upload/configuration/home/'.$shopValue['logo']) }}@endisset" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="{{ asset('/') }}">
                            @isset ($shopValue['shopName']) 
          {{ $shopValue['shopName'] }}@endisset
                            </a>
                        </h2>
                        <div>@isset ($shopValue['address']) 
          {{ $shopValue['address'] }}@endisset</div>
                        <div>@isset ($shopValue['phone']) 
          {{ $shopValue['phone'] }}@endisset</div>
                        <div>@isset ($shopValue['email']) 
          {{ $shopValue['email'] }}@endisset</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Người nhận:</div>
                        <h2 class="to">{{$order['id_customer']}}</h2>
                        <div class="address">{{$order['address']}}</div>
                        <div class="email">{{$order['phone_number']}}</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">Hóa đơn #{{$order['id_order']}}</h1>
                        <div class="date">Ngày đặt hàng: {{date_format($order['created_at'],"H:i:s d/m/Y")}}</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Tên sản phẩm</th>
                            <th class="text-right">Giá bán</th>
                            <th class="text-right">Số lượng</th>
                            <th class="text-right">Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                      @isset ($orderDetail)
                          @foreach ($orderDetail as $key => $value)
                            <tr>
                                <td class="no">{{$key+1}}</td>
                                <td class="text-left">{{$value['product_name']}}</td>
                                <td class="unit">{{number_format($value['price'], 2)}} VND</td>
                                <td class="qty">{{$value['product_quantity']}}</td>
                                <td class="total">{{number_format($value['total_price_product'], 2)}} VND</td>
                            </tr>
                          @endforeach
                      @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng tiền</td>
                            <td>@isset($order){{number_format($order->total_price, 2)}} @endisset VND</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Giá vận chuyển</td>
                            <td>@isset($order){{$order->total_shipping==0?'Miễn phí':number_format($order->total_shipping, 2).' VND'}}@endisset</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng thanh toán</td>
                            <td>@isset($order){{number_format($order->total_price_tax, 2)}}@endisset VND</td>
                        </tr>
                    </tfoot>
                </table>
                
                <div class="notices">
                    <div>Ghi chú:</div>
                    <div class="notice"></div>
                </div>
            </main>
            <footer>
                Cảm ơn quý khách đã mua hàng tại {{$shopValue['shopName']}}
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
    </div>
  </div>
</div>
      <div hidden>
        <div id="invoice-print">

    <div class="toolbar hidden-print">

  
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="@isset ($shopValue['logo']) 
          {{ asset('upload/configuration/home/'.$shopValue['logo']) }}@endisset" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                            @isset ($shopValue['shopName']) 
          {{ $shopValue['shopName'] }}@endisset
                            </a>
                        </h2>
                        <div>@isset ($shopValue['address']) 
          {{ $shopValue['address'] }}@endisset</div>
                        <div>@isset ($shopValue['phone']) 
          {{ $shopValue['phone'] }}@endisset</div>
                        <div>@isset ($shopValue['email']) 
          {{ $shopValue['email'] }}@endisset</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Người nhận:</div>
                        <h2 class="to">{{$order['id_customer']}}</h2>
                        <div class="address">{{$order['address']}}</div>
                        <div class="email">{{$order['phone_number']}}</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">Hóa đơn #{{$order['id_order']}}</h1>
                        <div class="date">Ngày đặt hàng: {{date_format($order['created_at'],"H:i:s d/m/Y")}}</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left ">Tên sản phẩm</th>
                            <th class="text-right ">Giá bán</th>
                            <th class="text-right ">Số lượng</th>
                            <th class="text-right">Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                      @isset ($orderDetail)
                          @foreach ($orderDetail as $key => $value)
                            <tr>
                                <td class="no">{{$key+1}}</td>
                                <td class="text-left">{{$value['product_name']}}</td>
                                <td class="unit">{{number_format($value['price'], 2)}} VND</td>
                                <td class="qty text-center">{{$value['product_quantity']}}</td>
                                <td class="text-right">{{number_format($value['total_price_product'], 2)}} VND</td>
                            </tr>
                          @endforeach
                      @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng tiền</td>
                            <td>@isset($order){{number_format($order->total_price, 2)}} @endisset VND</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Giá vận chuyển</td>
                            <td>@isset($order){{$order->total_shipping==0?'Miễn phí':number_format($order->total_shipping, 2).' VND'}}@endisset</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng thanh toán</td>
                            <td>@isset($order){{number_format($order->total_price_tax, 2)}}@endisset VND</td>
                        </tr>
                    </tfoot>
                </table>
                {{-- <div class="thanks">Cảm ơn!</div> --}}
                <div class="notices">
                    <div>Ghi chú:</div>
                    <div class="notice"></div>
                </div>
            </main>
            <footer>
                Cảm ơn quý khách đã mua hàng tại {{$shopValue['shopName']}}
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
      </div>
      @endsection