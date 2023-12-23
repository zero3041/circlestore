<div class="features">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Featured Products</span></h2>
                    <div class="second-links">
                        <a href="#" class="view-all">View All
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
                <div class="products main flexwrap">
                    @foreach($hotProduct as $value)
                        <div class="item">
                            <div class="media">
                                <div class="thumbnail">
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
{{--                                <div class="rating">--}}
{{--                                    <div class="stars"></div>--}}
{{--                                    <span class="mini-text">(2,548)</span>--}}
{{--                                </div>--}}
                                <h3 class="main-links"><a href="#">{{$value['name']}}</a></h3>
                                <div class="price">
                                    <span class="current">{{number_format($value['price_tax'])}}</span>
                                    <span class="normal mini-text">{{number_format($value['price_sale'])}}</span>
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
