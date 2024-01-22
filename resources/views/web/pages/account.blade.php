@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper" style="width: 700px;
                        margin: auto;">
                <div class="checkout ">
                    <div class="item left styled">

                        <h1>Chỉnh sửa thông tin</h1>
                        <form method="post" action="{{ route('postAccount',['id'=>$customer['id_customer']]) }}">
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
                            @csrf
                            <P>
                                <label for="email">Họ Tên<span></span></label>
                                <input value="{{$customer['name']}}" type="text" name="name" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="password">Email <span></span></label>
                                <input value="{{$customer['email']}}" type="email" id="password" name="email"  required>
                            </P>
                            <P>
                                <label for="email">Số Điện Thoại<span></span></label>
                                <input value="{{$customer['phone_number']}}" type="text" name="phone" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Tỉnh (Thành phố)<span></span></label>
                                <input value="{{$customer['city']}}" type="text" name="city" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Quận (Huyện)<span></span></label>
                                <input value="{{$customer['address1']}}" type="text" name="address1" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Phường (Xã)<span></span></label>
                                <input value="{{$customer['address2']}}" type="text" name="address2" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Số nhà(Thôn, xóm, tổ)<span></span></label>
                                <input value="{{$customer['address3']}}" type="text" name="address3" id="email" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="password">Mật Khẩu <span></span></label>
                                <input type="password" id="password" name="password"  >
                            </P>
                            <P>
                                <label for="password">Xác Nhận Mật Khẩu <span></span></label>
                                <input type="password" id="password" name="password_confirm"  >
                            </P>
                            <div class="primary-checkout">
                                <button type="submit" class="primary-button">Lưu thông tin</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
