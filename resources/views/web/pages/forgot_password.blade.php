@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper" style="width: 550px;
                        margin: auto;">
                <div class="checkout ">
                    <div class="item left styled">
                        <h1>Đăng Nhập</h1>
                        <form method="post" action="{{ route('resetPassword') }}">
                            @csrf
                            <P>
                                <label for="email">Email<span></span></label>
                                <input placeholder="Vui lòng nhập Email bạn đã đăng ký" type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <div class="primary-checkout">
                                <a href="{{ route('login') }}">Đăng nhập</a>
                                <button style="width:250px" type="submit" class="primary-button">Lấy Lại Mật Khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
