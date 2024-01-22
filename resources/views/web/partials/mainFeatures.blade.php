<div class="features">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Sản phẩm dành cho bạn</span></h2>
                    <div class="second-links">
                        <a href="http://127.0.0.1:8000/search?query=" class="view-all">Xem toàn bộ
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
                <div class="products main flexwrap">
                    @foreach($hotProduct as $value)
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
                                    <span class="current">{{number_format($value['price_sale'])}}₫</span>
                                    <span class="normal mini-text">{{number_format($value['price_tax'])}}₫</span>
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
            </div>
        </div>
    </div>
</div>
