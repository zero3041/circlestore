<div class="trending">
    <div class="container">
        <div class="wrapper">
            <div class="sectop flexitem">
                <h2><span class="circle"><span>Trending</span></span></h2>
            </div>
            <div class="column">
                <div class="flexwrap">
                    <div class="row products big">
                        <div class="item">
                            <div class="offer">
                                <p>Offer end at</p>
                                <ul class="flexcenter">
                                    <li>1</li>
                                    <li>15</li>
                                    <li>27</li>
                                    <li>60</li>
                                </ul>
                            </div>
                            <div class="media">
                                <div class="image">
                                    <a href="#">
                                        <img src="{{ asset('web/assets/products/apparel4.jpg') }}" alt="">
                                    </a>
                                </div>
                                <div class="hoverable">
                                    <ul>
                                        <li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>
                                        <li><a href="#"><i class="ri-eye-line"></i></a></li>
                                        <li><a href="#"><i class="ri-shuffle-line"></i></a></li>
                                    </ul>
                                </div>
                                <div class="discount circle flexcenter"><span>38%</span></div>
                            </div>
                            <div class="content">
                                <div class="rating">
                                    <div class="stars"></div>
                                    <span class="mini-text">(2,548)</span>
                                </div>
                                <h3 class="main-links"><a href="#">Happy Sailed</a></h3>
                                <div class="price">
                                    <span class="current">4,790,000đ</span>
                                    <span class="normal mini-text">2,990,000đ</span>
                                </div>
                                <div class="stock mini-text">
                                    <div class="qty">
                                        <span>Stock: <strong class="qty-available">107</strong></span>
                                        <span>Sold: <strong class="qty-sold ">3,456</strong></span>
                                    </div>
                                    <div class="bar">
                                        <div class="available"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row products mini">
                        @foreach($trendCol2 as $value)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail object-cover">
                                        <a href="#">
                                            <img src="{{ asset($value['image']) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>
                                            <li><a href="#"><i class="ri-eye-line"></i></a></li>
                                            <li><a href="#"><i class="ri-shuffle-line"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="discount circle flexcenter"><span>{{$value['on_sale']}}%</span></div>
                                </div>
                                <div class="content">
{{--                                    <div class="rating">--}}
{{--                                        <div class="stars"></div>--}}
{{--                                        <span class="mini-text">(2,548)</span>--}}
{{--                                    </div>--}}
                                    <h3 class="main-links"><a href="#">{{$value['name']}}</a></h3>
                                    <div class="price">
                                        <span class="current">{{number_format($value['price_tax'])}}</span>
                                        <span class="normal mini-text">{{number_format($value['price_sale'])}}</span>
                                    </div>
                                    <div class="mini-text">
                                        <p>2,975 sold</p>
                                        <p>FreeShip</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row products mini">
                        @foreach($trendCol1 as $value1)
                            <div class="item">
                                <div class="media">
                                    <div class="thumbnail object-cover">
                                        <a href="#">
                                            <img src="{{ asset($value1['image']) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>
                                            <li><a href="#"><i class="ri-eye-line"></i></a></li>
                                            <li><a href="#"><i class="ri-shuffle-line"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="discount circle flexcenter"><span>{{$value1['on_sale']}}%</span></div>
                                </div>
                                <div class="content">
                                    {{--                                    <div class="rating">--}}
                                    {{--                                        <div class="stars"></div>--}}
                                    {{--                                        <span class="mini-text">(2,548)</span>--}}
                                    {{--                                    </div>--}}
                                    <h3 class="main-links"><a href="#">{{$value1['name']}}</a></h3>
                                    <div class="price">
                                        <span class="current">{{number_format($value1['price_tax'])}}</span>
                                        <span class="normal mini-text">{{number_format($value1['price_sale'])}}</span>
                                    </div>
                                    <div class="mini-text">
                                        <p>2,975 sold</p>
                                        <p>FreeShip</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
