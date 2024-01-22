@extends('web.layout.layout')

@section('content')
    <div class="single-category">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="holder">

                        <div class="section">
                            <div class="row">
                                <div class="cat-head">
                                    <div class="breadcrumb">
                                        <ul class="flexitem datacategory" data-category-id="">
                                            <li><a href="{{ route('index') }}">Home</a></li>
                                            @isset($category) <li>{{$category->name}}</li>@endisset
                                            @isset($manufacturer) <li>{{$manufacturer->name}}</li>@endisset
                                        </ul>
                                    </div>
                                    <div class="page-title">
                                        @isset($category) <h1>{{$category->name}}</h1>@endisset
                                        @isset($manufacturer) <h1>{{$manufacturer->name}}</h1>@endisset
                                    </div>
                                    <div class="cat-navigation flexitem">
                                        <div class="item-filter desktop-hide">
                                            <a href="#" class="filter-trigger label">
                                                <i class="ri-menu-2-line ri-2x"></i>
                                                <span>Filter</span>
                                            </a>
                                        </div>
                                        <div class="item-sortir">
                                            <div class="label" onclick="toggleDropdown()">
                                                <span class="mobile-hide">Sắp xếp theo: Default</span>
                                                <div class="desktop-hide">Default</div>
                                                <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                            <ul id="sortDropdown" class="dropdown">
                                                <li onclick="changeSorting('default')">Default</li>
                                                <li onclick="changeSorting('name')">Theo tên</li>
                                                <li onclick="changeSorting('price_desc')">Theo giá giảm dần</li>
                                                <li onclick="changeSorting('price_asc')">Theo giá tăng dần</li>
                                            </ul>
                                        </div>


                                        {{--                                        <div class="item-perpage mobile-hide">--}}
                                        {{--                                            <div class="label">Items 10 per page</div>--}}
                                        {{--                                            <div class="desktop-hide">10</div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="item-options">--}}
                                        {{--                                            <div class="label">--}}
                                        {{--                                                <span class="mobile-hide">Show 10 per page</span>--}}
                                        {{--                                                <div class="desktop-hide">10</div>--}}
                                        {{--                                                <i class="ri-arrow-down-s-line"></i>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <ul>--}}
                                        {{--                                                <li>10</li>--}}
                                        {{--                                                <li>20</li>--}}
                                        {{--                                                <li>50</li>--}}
                                        {{--                                                <li>100</li>--}}
                                        {{--                                            </ul>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="products main flexwrap">
                                {{--                                {{ dd($product) }}--}}
                                @foreach($product as $value)
                                    <div class="item productstore" data-product-id="{{ $value['id_product'] }}">
                                        <div class="media">
                                            <div class="thumbnail">
                                                <a href="{{ route('productDetail',['id' => $value['id_product']]) }}">
                                                    <img src="{{ asset($value['image']) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="hoverable">
                                                <ul>
                                                    <li class="active"><a class="add-to-wishlist" href="#"><i class="ri-heart-line"></i></a></li>
                                                    {{--                                        <li><a href="#"><i class="ri-eye-line"></i></a></li>--}}
                                                    <li><a class="add-to-cart" href="#"><i class="ri-shopping-cart-line"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="discount circle flexcenter"><span>{{$value['on_sale']}}%</span></div>
                                        </div>
                                        <div class="content">
                                            @if($value['review'] !== 0)
                                                <div class="rating">
                                                    <div class="rating-box">
                                                        <div style="width: {{ $value['review'] }}%;" class="rating"></div>
                                                    </div>
                                                    {{--                                            <span class="mini-text">(2,548)</span>--}}
                                                </div>
                                            @endif
                                            <h3 class="main-links"><a href="{{ route('productDetail',['id' => $value['id_product']]) }}">{{$value['name']}}</a></h3>
                                            <div class="price">
                                                <span class="current">{{number_format($value['price_sale'])}}</span>
                                                <span class="normal mini-text">{{number_format($value['price_tax'])}}</span>
                                            </div>
                                            {{--                                <div class="footer">--}}
                                            {{--                                    <ul class="mini-text">--}}
                                            {{--                                        <li>Intel thế hệ thứ 10</li>--}}
                                            {{--                                        <li>GTX 1650Ti</li>--}}
                                            {{--                                        <li>16GB Dual</li>--}}
                                            {{--                                    </ul>--}}
                                            {{--                                </div>--}}
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="load-more flexcenter">
                                {{--         {                       {{$product->links('pagination::bootstrap-5')}}--}}
{{--                                {{dd($product)}}--}}
                                {{$product->links('pagination::semantic-ui')}}
                                {{--                                <div class="loading" style="display: none;">Đang tải...</div>--}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
