@extends('web.layout.layout')

@section('content')
    <div class="single-product">
        <div class="container">
            <div class="wrapper">
                <div class="breadcrumb">
                    <ul class="flexitem">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Laptop MSI GF75 THIN10SC</a></li>
                    </ul>
                </div>
                @if(session('status'))
                    <p class="login-box-msg" style="color:#C82333">{{session('status')}}</p>
                @endif
                @if($errors->any())
                    <p class="login-box-msg">
                    @foreach ($errors->all() as $err)
                        <div class="login-box-msg" style="color:#C82333">{{$err}}</div>
                        @endforeach
                        </p>
                        @endif
                <!-- breadcrumb  -->
                <div class="column">
                    <div class="products one">
                        <div class="flexwrap">
                            <div class="row">
                                <div class="item is_sticky">
                                    <div class="price">
                                        <span class="discount">{{ $product['on_sale'] }}%<br>OFF</span>
                                    </div>

                                    <div class="big-image">
                                        <div class="big-image-wrapper swiper-wrapper">
                                            @foreach($product['image'] as $key=>$value)
                                                <div class="image-show swiper-slide">
                                                    <a data-fslightbox href="{{ asset('upload/product/'.$value['url']) }}"><img src="{{ asset('upload/product/'.$value['url']) }}" alt=""></a>
                                                </div>
                                            @endforeach


                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>

                                    <div thumbSlider="" class="small-image">
                                        <ul class="small-image-wrapper flexitem swiper-wrapper">
                                            @foreach($product['image'] as $key=>$value)
                                                <li class="thumbnail-show swiper-slide">
                                                    <img src="{{ asset('upload/product/'.$value['url']) }}" alt="">
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item">
                                    <h1>{{ $product['name'] }}</h1>
                                    <div class="content">
                                        <div class="rating">
                                            @if($product['review'] !== 0)
                                                <div class="rating">
                                                    <div class="rating-box">
                                                        <div style="width: {{ $product['review'] }}%;" class="rating"></div>
                                                    </div>
                                                    {{--                                            <span class="mini-text">(2,548)</span>--}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="stock-sku">
                                            <span class="available">In Stock</span>
{{--                                            <span class="sku mini-text">SKU-881</span>--}}
                                        </div>
                                        <div class="price">
                                            <span class="current">{{ number_format($product['price_sale']) }}₫</span>
                                            <span class="normal">{{ number_format($product['price_tax']) }}₫</span>
                                        </div>
                                        <!-- <div class="colors">
                                            <p>Colors</p>
                                            <div class="variant">
                                                <form action="">
                                                    <p>
                                                        <input type="radio" name="color" id="cogrey">
                                                        <label for="cogrey" class="circle"></label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" name="color" id="coblue">
                                                        <label for="coblue" class="circle"></label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" name="color" id="cogreen">
                                                        <label for="cogreen" class="circle"></label>
                                                    </p>
                                                </form>
                                            </div>
                                        </div> -->
                                        <!-- <div class="sizes">
                                            <p>Size</p>
                                            <div class="variant">
                                                <form action="">
                                                    <p>
                                                        <input type="radio" name="color" id="size-40">
                                                        <label for="size-40" class="circle"><span>40</span></label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" name="color" id="size-41">
                                                        <label for="size-41" class="circle"><span>41</span></label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" name="color" id="size-42">
                                                        <label for="size-42" class="circle"><span>42</span></label>
                                                    </p>
                                                    <p>
                                                        <input type="radio" name="color" id="size-43">
                                                        <label for="size-43" class="circle"><span>43</span></label>
                                                    </p>
                                                </form>
                                            </div>
                                        </div> -->
                                        <div class="actions productstore" data-product-id="{{ $product['id_product'] }}">
                                            <!-- <div class="qty-control flexitem">
                                                <button class="minus circle">-</button>
                                                <input type="text" value="1">
                                                <button class="plus circle">+</button>
                                            </div> -->
                                            <div class="button-cart" style="flex:none"><button  class="primary-button add-to-cart">Thêm vào giỏ hàng</button></div>
{{--                                            <div class="button-cart"><button class="primary-button">Mua Ngay</button></div>--}}
                                            <div class="wish-share add-to-wishlist">
                                                <ul class="flexitem second-links">
                                                    <li>
                                                        <a href="#">
                                                            <span class="icon-large"><i class="ri-heart-line"></i></span>
                                                            <span>Yêu Thích</span>
                                                        </a>
                                                    </li>
                                                    <li>
{{--                                                        <a href="#">--}}
{{--                                                            <span class="icon-large"><i class="ri-share-line"></i></span>--}}
{{--                                                            <span>Share</span>--}}
{{--                                                        </a>--}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="description collapse">
                                            <ul>
                                                <li class="has-child expand">
                                                    <a href="#" class="icon-small">Thông tin sản phẩm</a>
                                                    <ul class="content">
                                                        @isset ($manufacturer) <li><span>Hãng</span> <span>{{ $manufacturer['name'] }}</span></li> @endisset
                                                        @isset ($feature)
                                                                @foreach ($feature as $value)
                                                                    <li><span>{{$value['name']}}</span> <span>{{$value['value']}}</span></li>
                                                                @endforeach
                                                        @endisset
                                                    </ul>
                                                </li>
                                                <li class="has-child">
                                                    <a href="#" class="icon-small">Chi tiết sản phẩm</a>
                                                    <div class="content">
                                                        @php(print $product['description'])
                                                    </div>
                                                </li>
                                                <!-- <li class="has-child">
                                                    <a href="#" class="icon-small">Custom</a>
                                                    <div class="content">
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>Size</th>
                                                                    <th>Bust<span class="mini-text">(cm)</span></th>
                                                                    <th>Waist<span class="mini-text">(cm)</span></th>
                                                                    <th>Hip<span class="mini-text">(cm)</span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>S</td>
                                                                    <td>82</td>
                                                                    <td>63</td>
                                                                    <td>89</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>L</td>
                                                                    <td>22</td>
                                                                    <td>33</td>
                                                                    <td>89</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XL</td>
                                                                    <td>81</td>
                                                                    <td>43</td>
                                                                    <td>82</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XL</td>
                                                                    <td>62</td>
                                                                    <td>93</td>
                                                                    <td>49</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XXL</td>
                                                                    <td>42</td>
                                                                    <td>63</td>
                                                                    <td>79</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>XXX</td>
                                                                    <td>22</td>
                                                                    <td>43</td>
                                                                    <td>59</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </li> -->
                                                <li class="has-child ">
                                                    <a href="#" class="icon-small">
                                                        Đánh giá
                                                        <span class="mini-text">{{ $product['totalReview'] }}</span>
                                                    </a>
                                                    <div class="content">
                                                        <div class="reviews">
                                                            <h4>Khách hàng đánh giá</h4>
                                                            <div class="review-block">
                                                                <div class="review-block-head">
                                                                    <div class="flexitem">
                                                                        <span class="rate-sum">{{ number_format($product['review']/20,2) }}</span>
                                                                        <span>{{ $product['totalReview'] }} đánh giá</span>
                                                                    </div>
                                                                    <a href="#reviews-form" class="secondary-button">Viết Đánh Giá</a>
                                                                </div>
                                                                <div class="review-block-body">
                                                                    <ul>
                                                                        @isset ($review)
                                                                            @foreach ($review as $value)

                                                                                    <li class="item">
                                                                                        <div class="review-form">
                                                                                            <p class="person">{{$value->id_customer}}</p>
                                                                                            <div class="rating">
                                                                                                <div class="rating-box">
                                                                                                    <div style="width:{{$value->vote*2}}0%" class="rating"></div>
                                                                                                </div>
                                                                                                {{--                                            <span class="mini-text">(2,548)</span>--}}
                                                                                            </div>
                                                                                            <p class="mini-text">{{date_format($value['created_at'],"H:i:s d/m/Y")}}</p>
                                                                                        </div>
                                                                                        <div class="review-rating rating">
                                                                                            <div class="star"></div>
                                                                                        </div>
                                                                                        <div class="review-text">
                                                                                            <p>{{$value->content}}</p>
                                                                                        </div>
                                                                                    </li>

                                                                            @endforeach
                                                                        @endisset
                                                                    </ul>
                                                                        @isset ($review)
                                                                            <div class="second-links">
                                                                                <a href="#" class="view-all">Xem tất cả bình luận <i class="ri-arrow-right-line"></i></a>
                                                                            </div>
                                                                        @endisset
                                                                </div>
                                                                <div id="reviews-form" class="review-form">
                                                                    <h4>Viết đánh giá</h4>
                                                                    <div class="rating">
                                                                        <p>Bạn đánh giá sản phẩm này bao nhiêu sao?</p>
                                                                        <div class="rate-this">
                                                                            <input type="radio" name="rating" id="star5" onclick="updateRating(5)">
                                                                            <label for="star5"><i class="ri-star-fill"></i></label>

                                                                            <input type="radio" name="rating" id="star4" onclick="updateRating(4)">
                                                                            <label for="star4"><i class="ri-star-fill"></i></label>

                                                                            <input type="radio" name="rating" id="star3" onclick="updateRating(3)">
                                                                            <label for="star3"><i class="ri-star-fill"></i></label>

                                                                            <input type="radio" name="rating" id="star2" onclick="updateRating(2)">
                                                                            <label for="star2"><i class="ri-star-fill"></i></label>

                                                                            <input type="radio" name="rating" id="star1" onclick="updateRating(1)">
                                                                            <label for="star1"><i class="ri-star-fill"></i></label>
                                                                        </div>
                                                                    </div>
                                                                    <form method="POST" action=" {{ route('review',['id'=>$product['id_product']]) }}">
                                                                        @csrf
                                                                        <p>
                                                                            <label for="">Review</label>
                                                                            <textarea name="comment" id="" cols="30" rows="10"></textarea>
                                                                        </p>
                                                                        <input name="rating" type="hidden" id="ratingValue" value="">
                                                                        <p><button style="border: none;" type="submit" class="primary-button">Đánh giá</button></p>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
