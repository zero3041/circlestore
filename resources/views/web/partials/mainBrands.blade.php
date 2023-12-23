<div class="brands">
    <div class="container">
        <div class="wrapper flexitem">
            @foreach($manufacturer as $value)
                <div class="item">
                    <a href="#">
                        <img width="100" src="{{ asset('upload/manufacturer/' . $value['url']) }}" alt="">
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
