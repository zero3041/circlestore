@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper" style="width: 700px;
                        margin: auto;">
                <div class="checkout ">
                    <div class="item left styled">
                        <h1>Đăng Ký</h1>
                        <form method="post" action="{{ route('register') }}">
                            @csrf
                            <P>
                                <label for="email">Họ Tên<span></span></label>
                                <input type="text" name="name" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="password">Email <span></span></label>
                                <input type="email" id="password" name="email"  required>
                            </P>
                            <P>
                                <label for="email">Số Điện Thoại<span></span></label>
                                <input type="text" name="phone" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Tỉnh (Thành phố)<span></span></label>
                                <input type="text" name="city" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Quận (Huyện)<span></span></label>
                                <input type="text" name="address1" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Phường (Xã)<span></span></label>
                                <input type="text" name="address2" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Số nhà(Thôn, xóm, tổ)<span></span></label>
                                <input type="text" name="address3" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="password">Mật Khẩu <span></span></label>
                                <input type="password" id="password" name="password"  required>
                            </P>
                            <P>
                                <label for="password">Xác Nhận Mật Khẩu <span></span></label>
                                <input type="password" id="password" name="password_confirm"  required>
                            </P>
                            <div class="primary-checkout">
                                <a href="{{ route('login') }}">Đăng Nhập</a>
                                <button type="submit" class="primary-button">Đăng Ký</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
