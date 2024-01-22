@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper" style="width: 550px;
                                        margin: auto;">
                <div class="checkout ">

                    <div class="item left styled">
                        <h1>Đăng Nhập</h1>
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
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <P>
                                <label for="email">Email<span></span></label>
                                <input type="email" name="email" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="password">Mật Khẩu <span></span></label>
                                <input type="password" id="password" name="password"  required>
                            </P>
                            <div class="primary-checkout">
                                <a href="{{ route('resetPassword') }}">Quên mật khẩu ?</a><br><br>
                                <a href="{{ route('register') }}">Đăng ký ngay.</a>
                                <button type="submit" class="primary-button">Đăng Nhập</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
