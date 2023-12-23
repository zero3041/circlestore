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
                        <form action="" class="form-cart">
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
                                    <tr>
                                        <td class="flexitem">
                                            <div class="thumbnail object-cover">
                                                <a href="#">
                                                    <img src="assets/products/home2.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <strong><a href="#">Laptop Acer Nitro 5</a></strong>
{{--                                                <p>Color: Gold</p>--}}
                                            </div>
                                        </td>
                                        <td>$279.99</td>
                                        <td>
                                            <div class="qty-control flexitem">
                                                <button class="minus">-</button>
                                                <input type="text" value="2" min="1">
                                                <button class="plus">+</button>
                                            </div>
                                        </td>
                                        <td>21,300,000 đ</td>
                                        <td><a href="#" class="item-remove"><i class="ri-close-line"></i></a></td>
                                    </tr>


                                </table>
                            </div>
                        </form>
                        <div class="cart-summary styled">
                            <div class="item">
                                <div class="coupon">
                                    <input type="text" name="" id="" placeholder="Nhập mã giảm giá">
                                    <button>Áp Dụng</button>
                                </div>

                                <div class="cart-total">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td>21,300,300 đ</td>
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
                                            <td><br><strong>221,300,300₫</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="/check-out.html" class="secondary-button">Tiến Hành Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
