@extends('web.layout.layout')
@section('content')
    <div class="single-cart">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="#">Trang chủ</a></li>
                        <li>Đơn hàng</li>
                    </ul>
                </div>
                <div style="margin-bottom:20px" class="page-tittle">
                    <h1>Danh sách đơn hàng</h1>
                </div>
                <div class="products one cart">
                    <div  class="flexwrap">
                        <form action="" class="form-cart" style="width:100%">
                            <div class="item">
                                <table id="cart-table">
                                    <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Giá Vận Chuyển</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Xem chi tiết</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset ($order)
                                        @foreach ($order as $value)
                                            <tr>
                                                <td>{{$value['id_order']}}</td>
                                                <td>{{$value['created_at']}}</td>
                                                <td>{{number_format($value['total_shipping'])}} VND</td>
                                                <td>{{number_format($value['total_price_tax'])}} VND</td>
                                                <td><em>{{$value['status']}}</em></td>
                                                <td class="a-center last"><span class="nobr"> <a href="{{route('orderDetail',['id'=>$value['id_order']])}}">Xem chi tiết</a>  </span></td>
                                            </tr>
                                        @endforeach
                                    @endisset


                                    </tbody>
                                </table>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
