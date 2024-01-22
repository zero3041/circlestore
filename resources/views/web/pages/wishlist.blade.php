@extends('web.layout.layout')
@section('content')
     <div class="single-cart">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="#">Home</a></li>
                        <li>Yêu thích</li>
                    </ul>
                </div>
                <div class="page-tittle">
                    <h1>Yêu thích</h1>
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
                                    @foreach($product as $value)
                                        <tbody>
                                        <tr>
                                            <td class="flexitem">
                                                <div class="thumbnail object-cover">
                                                    <a href="#">
                                                        <img src="http://localhost:8000/{{ $value->image }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <strong><a href="#">{{ $value->name }}</a></strong>
                                                    {{--                                                <p>Color: Gold</p>--}}
                                                </div>
                                            </td>
                                            <td>{{ number_format($value->price_sale) }}₫</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td><a href="{{ route('removeWishlist',['id_product'=>$value->id_product]) }}" class="item-remove"><i class="ri-close-line"></i></a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
