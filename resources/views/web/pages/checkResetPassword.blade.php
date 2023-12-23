@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper" style="width: 550px;
                        margin: auto;">
                <div class="checkout ">
                    <div class="item left styled">
                        <h1>Đặt lại mật khẩu</h1>
                        <form method="post" action="{{ route('checkResetPassword') }}">
                            @csrf
                            <input type="hidden" value="{{$id}}" name="id">
                            <input type="hidden" value="{{$hash}}" name="hash">
                            <P>
                                <label for="password">Mật khẩu mới <span></span></label>
                                <input type="password" id="password" name="password"  required>
                            </P>
                            <P>
                                <label for="password">Xác nhận mật khẩu <span></span></label>
                                <input type="password" id="password" name="password_confirm"  required>
                            </P>
                            <div class="primary-checkout">
                                <button type="submit" class="primary-button">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
