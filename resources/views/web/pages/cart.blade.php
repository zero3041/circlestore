@extends('web.layout.layout')
@section('content')
    <div class="single-cart">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="#">Home</a></li>
                        <li>cart</li>
                    </ul>
                </div>
                <div class="page-tittle">
                    <h1>Giỏ hàng</h1>
                </div>
                <div class="products one cart">
                    <div class="flexwrap">
                        <form method="get" action="{{route('updateCart')}}" class="form-cart">
                            <div class="item">
                                <table id="cart-table">
                                    <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $value)
                                        @php($key=1)
                                        <input hidden="" name="rowId[]" value="{{$value->rowId}}">
                                            <tr>
                                                <td class="flexitem">
                                                    <div class="thumbnail object-cover">
                                                        <a href="#">
                                                            <img src="{{ asset('upload/product/'.$value->options['image']) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <strong><a href="#">{{ $value->name }}</a></strong>
                                                        {{--                                                <p>Color: Gold</p>--}}
                                                    </div>
                                                </td>
                                                <td>{{ number_format($value->price) }}₫</td>
                                                <td>
                                                    <div class="qty-control flexitem">

                                                        <button class="minus">-</button>
                                                        <input name="qty[]" type="text" value="{{ $value->qty }}" min="1">
                                                        <button type="submit" class="plus">+</button>
                                                    </div>
                                                </td>
                                                <td><span>{{ number_format($value->subtotal)  }}đ</span></td>
                                                <td><a href="{{ route('removeToCart',['rowId' => $value->rowId]) }}" class="item-remove"><i class="ri-close-line"></i></a></td>
                                            </tr>
                                    @endforeach
                                </table>
                            </div>
                            @isset($key)
                                <button type="submit" style="border:none;" class="btn secondary-button"><i class="ri-refresh-line"></i></button>
                            @endisset

                        </form>
                        <div class="cart-summary styled">
                            <div style="position: sticky; top: 20px;" class="item">
{{--                                <div class="coupon">--}}
{{--                                    <input type="text" name="" id="" placeholder="Nhập mã giảm giá">--}}
{{--                                    <button>Áp Dụng</button>--}}
{{--                                </div>--}}

                                <div class="cart-total">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td>{{number_format(Cart::total())}}₫</td>
                                        </tr>
                                        <tr>
                                            <th>Giảm giá</th>
                                            <td></td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Shipping <span class="mini-text">(Flat)</span></th>--}}
{{--                                            <td>$10.10</td>--}}
{{--                                        </tr>--}}
                                        <tr class="grand-total">
                                            <th>TỔNG CỘNG</th>
                                            <td><br><strong>{{number_format(Cart::total())}}₫</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{route('checkout')}}" class="secondary-button">Tiến Hành Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
