<div class="slider">
    <div class="container">
        <div class="wrapper">
            <div class="myslider swiper">
                <div class="swiper-wrapper">
                    @foreach($slider as $value)
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image object-cover ">
                                    <img src="{{ asset( 'upload/slide/' . $value['url'] ) }}" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h4>{{ $value['text1'] }}</h4>
                                    <h2><span>{{ $value['text2'] }}</span><br><span>{{ $value['text3'] }}</span></h2>
{{--                                    <a href="#" class="primary-button">Mua Ngay</a>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
{{--                <div class="swiper-pagination"></div>--}}
            </div>
        </div>
    </div>
</div>
