<div class="trending">
    <div class="container">
        <div class="wrapper">
            <div class="sectop flexitem">
                <h2><span class="circle"><span>Trending</span></span></h2>
            </div>
            <div class="column">
                <div class="flexwrap">
                    @foreach($sale as $time)
                    <div class="row products big">
                        <div  class="item productstore" data-product-id="{{ $time['id_product'] }}">
                            <div class="offer">
                                <p>Sẽ Kết Thúc</p>
                                <input hidden type="date" name="deadline" value="{{$time['time']}}">
                                <ul class="flexcenter">
                                    <li id="days">0</li>
                                    <li id="hours">0</li>
                                    <li id="minutes">0</li>
                                    <li id="seconds">0</li>

                                </ul>
                                <script>
                                    function updateCountdown() {
                                        var deadline = new Date(document.getElementsByName('deadline')[0].value + "T00:00:00Z").getTime();
                                        var now = new Date().getTime();
                                        var timeRemaining = deadline - now;

                                        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                                        document.getElementById("days").innerText = days;
                                        document.getElementById("hours").innerText = hours;
                                        document.getElementById("minutes").innerText = minutes;
                                        document.getElementById("seconds").innerText = seconds;
                                    }

                                    setInterval(updateCountdown, 1000);

                                    updateCountdown();
                                </script>

                            </div>
                            <div class="media">
                                <div class="image">
                                    <a href="#">
                                        <img src="{{$time['image']}}" alt="">
                                    </a>
                                </div>
                                <div class="hoverable">
                                    <ul>
                                        <li class="active"><a class="add-to-wishlist" href="#"><i class="ri-heart-line"></i></a></li>
                                        {{--                                        <li><a href="#"><i class="ri-eye-line"></i></a></li>--}}
                                        <li><a class="add-to-cart" href="#"><i class="ri-shopping-cart-line"></i></a></li>
                                    </ul>
                                </div>
                                <div class="discount circle flexcenter"><span>{{$time['on_sale']}}%</span></div>
                            </div>
                            <div class="content">
{{--                                {{ dd() }}--}}
                                @if($time['review'] !== 0)
                                    <div class="rating">
                                        <div class="rating-box">
                                            <div style="width: {{ $time['review'] }}%;" class="rating"></div>
                                        </div>
                                        {{--                                            <span class="mini-text">(2,548)</span>--}}
                                    </div>
                                @endif
                                <h3 class="main-links"><a href="#">{{$time['name']}}</a></h3>
                                <div class="price">
                                    <span class="current">{{number_format($time['price_tax'])}}₫</span>
                                    <span class="normal mini-text">{{number_format($time['price_sale'])}}₫</span>
                                </div>
{{--                                <div class="stock mini-text">--}}
{{--                                    <div class="qty">--}}
{{--                                        <span>Stock: <strong class="qty-available">107</strong></span>--}}
{{--                                        <span>Sold: <strong class="qty-sold ">3,456</strong></span>--}}
{{--                                    </div>--}}
{{--                                    <div class="bar">--}}
{{--                                        <div class="available"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row products mini">
                        @foreach($trendCol2 as $value)
                            <div class="item productstore" data-product-id="{{ $value['id_product'] }}">
                                <div class="media">
                                    <div class="thumbnail object-cover">
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
                                    <div class="mini-text">
{{--                                        <p>2,975 sold</p>--}}
{{--                                        <p>FreeShip</p>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row products mini">
                        @foreach($trendCol1 as $value1)
{{--                            {{ dd($value1) }}--}}
                            <div class="item productstore" data-product-id="{{ $value1['id_product'] }}">
                                <div class="media">
                                    <div class="thumbnail object-cover">
                                        <a href="{{ route('productDetail',['id' => $value1['id_product']]) }}">
                                            <img src="{{ asset($value1['image']) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="hoverable">
                                        <ul>
                                            <li class="active"><a class="add-to-wishlist" href="#"><i class="ri-heart-line"></i></a></li>
                                            {{--                                        <li><a href="#"><i class="ri-eye-line"></i></a></li>--}}
                                            <li><a class="add-to-cart" href="#"><i class="ri-shopping-cart-line"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="discount circle flexcenter"><span>{{$value1['on_sale']}}%</span></div>
                                </div>
                                <div class="content">
                                    @if($value1['review'] !== 0)
                                        <div class="rating">
                                            <div class="rating-box">
                                                <div style="width: {{ $value1['review'] }}%;" class="rating"></div>
                                            </div>
                                            {{--                                            <span class="mini-text">(2,548)</span>--}}
                                        </div>
                                    @endif

                                    <h3 class="main-links"><a href="{{ route('productDetail',['id' => $value['id_product']]) }}">{{$value1['name']}}</a></h3>
                                    <div class="price">
                                        <span class="current">{{number_format($value1['price_sale'])}}₫</span>
                                        <span class="normal mini-text">{{number_format($value1['price_tax'])}}₫</span>
                                    </div>
                                    <div class="mini-text">
{{--                                        <p>2,975 sold</p>--}}
{{--                                        <p>FreeShip</p>--}}
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
