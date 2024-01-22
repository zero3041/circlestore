@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper">
                <div class="checkout flexwrap">
                    <div class="item left styled">
                        <h1>Chi tiết đơn hàng</h1>
                        <form action="">
                            <P>
                                <label for="email">Họ Tên <span></span></label>
                                <input value="{{$customer['name']}}" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="name">Số điện thoại<span></span></label>
                                <input value="{{$customer['phone_number']}}" type="text" id="name"  required>
                            </P>
                            <p>
                                <label>Địa chỉ</label>
                                <textarea cols="30" rows="10">{{$order->address}}</textarea>
                            </p>
                            <P>
                                <label for="email">Tình trạng thanh toán<span></span></label>
                                <input value="{{$order['payment']}}" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Phương thức thanh toán<span></span></label>
                                <input value="{{$order['check']}}" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Trạng thái đơn hàng<span></span></label>
                                <input value="{{$order['status']}}" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Nhà vận chuyển<span></span></label>
                                <input value="{{$order['id_carrier']}}" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                        </form>


                    </div>
                    <div class="item right">
                        <h2>Sản phẩm</h2>
                        <div class="summary-order is_sticky">
                            <div class="summary-totals">
                                <ul>
                                    <li>
                                        <span>Total</span>
                                        <span>{{number_format($order['total_price'])}}</span>
                                    </li>
                                </ul>
                            </div>
                            <ul class="products mini">
                                @foreach($orderDetail as $value)
                                    <li class="item">
                                        <div class="thumbnail object-cover">
                                            <img src="http://127.0.0.1:8000/upload/product/home/{{$value['image']}}" alt="">
                                        </div>
                                        <div class="item-content">
                                            <p>{{ $value['product_name'] }}</p>
                                            <span class="price">
                                                    <span>{{number_format($value['price']) }}</span>
                                                    <span>x {{ $value['product_quantity'] }}</span>
                                                </span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
