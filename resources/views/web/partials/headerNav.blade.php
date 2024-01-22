<div class="header-nav">
    <div class="container">
        <div class="wrapper flexitem">
            <a href="#" class="trigger desktop-hide"><span class="i ri-menu-2-line"></span></a>
            <div class="left flexitem">
                <div class="logo"><a href="/"><span class="circle"></span>.Store</a></div>
                <nav class="mobile-hide">
                    <ul class="flexitem second-link">
                        <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                        <li class="has-child">
                            <a href="{{route('category',['id'=>8])}}">Laptop
                                <div class="icon-small"><i class="ri-arrow-down-s-line"></i></div>
                            </a>
                            <div class="mega">
                                <div class="container">
                                    <div class="wrapper">
{{--                                        {{ dd($category) }}--}}
                                        @foreach ($category as $value)

                                            @foreach ($value['level2'] as $level2)
                                                <div class="flexcol">
                                                    <div class="row">
{{--                                                        <h4>{{ $level2['name'] }}</h4>--}}
                                                        <ul>
                                                            <li>
                                                                <a href="{{route('category',['id'=>$level2['id_category']])}}">{{ $level2['name'] }}</a>
                                                                @if (isset($level2['level3']))
                                                                    <ul>
                                                                        @foreach ($level2['level3'] as $level3)
                                                                            <li><a href="{{route('category',['id'=>$level3['id_category']])}}">{{ $level3['name'] }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach

{{--                                        <div class="flexcol">--}}
{{--                                            <div class="products">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="media">--}}
{{--                                                        <div class="thumbnail object-cover">--}}
{{--                                                            <a href="#">--}}
{{--                                                                <img src="{{ asset('web/assets/products/apparel4.jpg') }}" alt="">--}}
{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="text-content">--}}
{{--                                                        <h4>Có thể bạn muốn mua</h4>--}}
{{--                                                        <a href="#" class="primary-button">Order Now</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">PC</a></li>
                        <li>
                            <a href="http://127.0.0.1:8000/category/45">Đồ Chơi Công Nghệ
                                <div class="fly-item"><span>New!</span></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="right">
                <ul class="flexitem second-links">
                    <li class="mobile-hide">
                        <a href="{{ route('wishlist') }}">
                            <div class="icon-large"><i class="ri-heart-line"></i></div>
{{--                            <div class="fly-item">--}}
{{--                                <span class="item-number">--}}
{{--                                    @if(Auth::guard('customer')->check())--}}
{{--                                        {{ $wishlistCount }}--}}
{{--                                    @else--}}
{{--                                        0--}}
{{--                                    @endif--}}
{{--                                </span>--}}
{{--                            </div>--}}
                        </a>
                    </li>
                    <li class="iscart">
                        <a href="{{ route('cart') }}" >
                            <div class="icon-large">
                                <i class="ri-shopping-cart-fill"></i>
                                <div class="fly-item"><span class="item-number">{{Cart::count()}}</span></div>
                            </div>
                            <div class="icon-text">
                                <div class="mini-text">Tổng</div>
                                <div class="cart-total">{{number_format(Cart::total())}}</div>
                            </div>
                        </a>
{{--                        <div class="mini-cart">--}}
{{--                            <div class="content">--}}
{{--                                <div class="cart-head">--}}
{{--                                    5 Sản phẩm trong giỏ hàng--}}
{{--                                </div>--}}
{{--                                <div class="cart-body">--}}
{{--                                    <ul class="products mini">--}}
{{--                                        <li class="item">--}}
{{--                                            <div class="thumbnail object-cover">--}}
{{--                                                <a href="#"><img src="{{ asset('web/assets/products/home2.jpg') }}" alt=""></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="item-content">--}}
{{--                                                <p><a href="#">Lorem ipsum dolor sit.</a></p>--}}
{{--                                                <span class="price">--}}
{{--                                                                <span>20,000 đ</span>--}}
{{--                                                                <span class="fly-item"><span>2x</span></span>--}}
{{--                                                            </span>--}}
{{--                                            </div>--}}
{{--                                            <a href="#" class="item-remove"><i class="ri-close-line"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="item">--}}
{{--                                            <div class="thumbnail object-cover">--}}
{{--                                                <a href="#"><img src="{{ asset('web/assets/products/home2.jpg') }}" alt=""></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="item-content">--}}
{{--                                                <p><a href="#">Lorem ipsum dolor sit.</a></p>--}}
{{--                                                <span class="price">--}}
{{--                                                                <span>20,000 đ</span>--}}
{{--                                                                <span class="fly-item"><span>2x</span></span>--}}
{{--                                                            </span>--}}
{{--                                            </div>--}}
{{--                                            <a href="#" class="item-remove"><i class="ri-close-line"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="item">--}}
{{--                                            <div class="thumbnail object-cover">--}}
{{--                                                <a href="#"><img src="{{ asset('web/assets/products/home2.jpg') }}" alt=""></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="item-content">--}}
{{--                                                <p><a href="#">Lorem ipsum dolor sit.</a></p>--}}
{{--                                                <span class="price">--}}
{{--                                                                <span>20,000 đ</span>--}}
{{--                                                                <span class="fly-item"><span>2x</span></span>--}}
{{--                                                            </span>--}}
{{--                                            </div>--}}
{{--                                            <a href="#" class="item-remove"><i class="ri-close-line"></i></a>--}}
{{--                                        </li>--}}
{{--                                        <li class="item">--}}
{{--                                            <div class="thumbnail object-cover">--}}
{{--                                                <a href="#"><img src="{{ asset('web/assets/products/home2.jpg') }}" alt=""></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="item-content">--}}
{{--                                                <p><a href="#">Lorem ipsum dolor sit.</a></p>--}}
{{--                                                <span class="price">--}}
{{--                                                                <span>20,000 đ</span>--}}
{{--                                                                <span class="fly-item"><span>2x</span></span>--}}
{{--                                                            </span>--}}
{{--                                            </div>--}}
{{--                                            <a href="#" class="item-remove"><i class="ri-close-line"></i></a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div class="cart-footer">--}}
{{--                                    <div class="subtotal">--}}
{{--                                        <p>Tổng Tiền</p>--}}
{{--                                        <p><strong>160,000 đ</strong></p>--}}
{{--                                    </div>--}}
{{--                                    <div class="actions">--}}
{{--                                        <a href="/cart.html" class="primary-button">Thanh toán</a>--}}
{{--                                        <a href="/checkout.hmtl" class="secondary-button">Xem giỏ hàng</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
