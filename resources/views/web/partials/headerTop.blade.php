<div class="header-top mobile-hide">
    <div class="container">
        <div class="wrapper flexitem">
            <div class="left">
                <ul class="flexitem main-links">
{{--                    <li><a href="">Blog</a></li>--}}
{{--                    <li><a href="">Sản Phẩm Nổi Bật</a></li>--}}
                    <li><a href="{{ route('wishlist') }}">Danh Sách Yêu Thích</a></li>
                </ul>
            </div>
            <div class="right">
                <ul class="flexitem main-links">
                    <li>
                        @if(Auth::guard('customer')->check())
                            <a href="{{ route('logout') }}">Đăng Xuất</a>
                        @endif
                        @if(!Auth::guard('customer')->check())
                            <a href="{{ route('login') }}">Đăng Nhập</a>
                        @endif

                    </li>
                    <li><a href="{{route('account')}}">Tài Khoản</a></li>
                    <li><a href="{{ route('orderCustomer') }}">Theo Dõi Đơn Hàng</a></li>
                    <li>
                        <a href="#">VNĐ <span class="icon-small"><i class="ri-arrow-down-s-line"></i></span></a>
                        <ul>
                            <li class="current"><a href="#">VNĐ</a></li>
{{--                            <li><a href="#">USD</a></li>--}}
                        </ul>
                    </li>
                    <li>
                        <a href="#">Việt Nam <span class="icon-small"><i class="ri-arrow-down-s-line"></i></span></a>
                        <ul>
                            <li class="current"><a href="#">Việt Nam</a></li>
{{--                            <li><a href="#">English</a></li>--}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
