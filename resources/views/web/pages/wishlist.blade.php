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
                        <form action="" class="form-cart" style="width:100%">
                            <div class="item">
                                <table id="cart-table">
                                    <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng trong kho</th>
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
                                        <td>21,300,000</td>
                                        <td>23</td>
                                        <td><a href="#" class="item-remove"><i class="ri-close-line"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
