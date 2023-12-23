<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Barlow&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/invoice.css') }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div id="invoice">

    <div class="toolbar hidden-print">
         <div class="text-right">
            <button id="print-invoice" class="btn btn-info"><i class="fa fa-print"></i> In hóa đơn hoặc xuất file PDF</button>
        </div>
  
    </div>
    <div id="invoice-print">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
{{--                     <div class="col">
                        <a target="_blank" href="{{ route('index') }}">
                            <img src="@isset ($shopValue['logo']) 
          {{ asset('upload/configuration/home/'.$shopValue['logo']) }}@endisset" data-holder-rendered="true" />
                            </a>
                    </div> --}}
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="{{ route('index') }}">
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
                        <h2 class="to">{{$data[0]['id_customer']}}</h2>
                        <div class="address">{{$data[0]['address']}}</div>
                        <div class="email">{{$data[0]['phone_number']}}</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">Hóa đơn #{{$data[0]['id_order']}}</h1>
                        <div class="date">Ngày đặt hàng: {{date_format($data[0]['created_at'],"H:i:s d/m/Y")}}</div>
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
                    	@isset ($data[1])
                    	    @foreach ($data[1] as $key => $value)
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
                            <td>@isset($data[0]){{number_format($data[0]->total_price)}} @endisset VND</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Giá vận chuyển</td>
                            <td>@isset($data[0]){{$data[0]->total_shipping==0?'Miễn phí':number_format($data[0]->total_shipping).' VND'}}@endisset</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng thanh toán</td>
                            <td>@isset($data[0]){{number_format($data[0]->total_price_tax)}}@endisset VND</td>
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
</body>
<script src="{{ asset('front/js/print.min.js')}}"></script>
</html>