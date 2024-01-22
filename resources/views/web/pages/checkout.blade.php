@extends('web.layout.layout')
@section('content')
    <div class="single-checkout">
        <div class="container">
            <div class="wrapper">
                <div class="checkout flexwrap">
                    <div class="item left styled">
                        <h1>Thông tin người nhận</h1>

                            @if($errors->any())
                                    @foreach ($errors->all() as $err)
                                    <h4 style="color:red">{{$err}}</h4>
                                    @endforeach
                            @endif

                        <form action="{{ route('order') }}" method="post">
                            @csrf
                            <P>
                                <label for="email">Họ tên <span></span></label>
                                <input name="name" value="{{ $customer->name }}" type="text" autocomplete="off" required>
                            </P>
                            <P>
                                <label for="email">Email <span></span></label>
                                <input name="email" value="{{ $customer->email }}" type="email" autocomplete="off" required="email">
                            </P>
                            <P>
                                <label for="cname">Số điện thoại<span></span></label>
                                <input name="phone_number" value="{{ $customer->phone_number }}" type="text" id="cname"  required>
                            </P>
                            <P>
                                <label for="adress">Tỉnh (Thành Phố)<span></span></label>
                                <input name="city" value="{{ $customer->city }}"type="text" id="adress"  required>
                            </P>
                            <P>
                                <label for="city">Quận (Huyện)<span></span></label>
                                <input name="address1" value="{{ $customer->address1 }}" type="text" id="city"  required>
                            </P>
                            <P>
                                <label for="state">Phường (Xã)<span></span></label>
                                <input name="address2" value="{{ $customer->address2 }}" type="text" id="state"  required>
                            </P>
                            <P>
                                <label for="postal">Số Nhà(Thôn, Xóm, Tổ)<span></span></label>
                                <input name="address3" value="{{ $customer->address3 }}" type="text" id="postal"  required>
                            </P>
{{--                            <p>--}}
{{--                                <label for="country">Country</label>--}}
{{--                                <select name="country" id="">--}}
{{--                                    <option value=""></option>--}}
{{--                                    <option value="1">USA</option>--}}
{{--                                    <option value="2" selected>VN</option>--}}
{{--                                </select>--}}
{{--                            </p>--}}
{{--                            <P>--}}
{{--                                <label for="phone">Phone Number<span></span></label>--}}
{{--                                <input type="number" id="phone"  required>--}}
{{--                            </P>--}}
{{--                            <p>--}}
{{--                                <label>Order Notes (optional)</label>--}}
{{--                                <textarea cols="30" rows="10"></textarea>--}}
{{--                            </p>--}}
{{--                            <p class="checkset">--}}
{{--                                <input type="checkbox"  id="anaccount">--}}
{{--                                <label for="anaccount">Create An Account?</label>--}}
{{--                            </p>--}}
                            <div class="shipping-methods">
                                <h2>Nhà vận chuyển</h2>
                                @foreach($carrier as $value)
                                    <p class="checkset">
                                        <input name="carrier" type="radio" value="{{$value->id_carrier}}">
                                        <label>{{ $value->name.'('.number_format($value->price).'đ)' }}</label>
                                    </p>
                                @endforeach
                            </div>
                            <div class="shipping-methods">
                                <h2>Phương thức thanh toán</h2>
                                    <p class="checkset">
                                        <input name="payment" type="radio" value="0">
                                        <label>Thanh Toán Khi Nhận Hàng</label>
                                    </p>
                                <p class="checkset">
                                    <input name="payment" type="radio" value="1">
                                    <label>Thanh Toán Qua VN Pay</label>
                                </p>
                            </div>
                            <div class="primary-checkout">
                                <button class="primary-button">Mua Hàng</button>
                            </div>
                        </form>

                    </div>
{{--                    {{ dd(Cart::content()) }}--}}
                    <div class="item right">
                        <div class="cart-summary styled is_sticky">
                            <div style="position: sticky;top: 20px;" class="item">
                                <div class="coupon">
                                    <input id="voucherCodeInput" name="voucher_code" type="text" placeholder="Nhập mã giảm giá">
                                    <button id="applyDiscountBtn">Áp Dụng</button>
                                </div>
                                <div class="cart-total">
                                    <table>
                                        <tbody>
                                            @foreach(Cart::content() as $key)
                                                @isset($key->options['voucher_applied'])
                                                    @if($key->options['voucher_applied']==true)
                                                        @php($voucher=true)
                                                    @endif
                                                @endisset
                                                @isset($key->options['applied_voucher_code'])
                                                    @if($key->options['applied_voucher_code']!=null)
                                                        @php($voucher_code = $key->options['applied_voucher_code'])
                                                    @endif
                                                @endisset
                                            @endforeach
                                            @if(isset($voucher))
                                                <tr>
                                                    <th style="color: red">Mã giảm giá: {{ $voucher_code }}</th>
                                                    <td><button style="border: solid 1px" class="secondary-button cancel-discount-btn">Huỷ áp dụng</button></td>

                                                </tr>
                                            @endif

                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td>{{number_format(Cart::total())}}₫</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Giảm giá</th>--}}
{{--                                            <td>{{number_format(Cart::total()-)}}</td>--}}
{{--                                        </tr>--}}
                                        <tr class="grand-total">
                                            <th>TỔNG CỘNG</th>
                                            <td><br><strong>{{ number_format(Cart::total()) }}₫</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <ul class="products mini">
                                        @foreach(Cart::content() as $value)
                                            <li class="item">
                                                <div class="thumbnail object-cover">
                                                    <img src="{{ asset('upload/product/'.$value->options['image']) }}" alt="">
                                                </div>
                                                <div class="item-content">
                                                    <p>{{ $value->name  }}</p>
                                                    <span class="price">
                                                    <span>{{ number_format($value->price) }}₫</span>
                                                    <span>x {{ $value->qty }}</span>
                                                </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
{{--                        <h2>Order Summary</h2>--}}
{{--                        <div class="summary-order is_sticky">--}}
{{--                            <div class="summary-totals">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <span>Subtotal</span>--}}
{{--                                        <span>$2112.21</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <span>Discount</span>--}}
{{--                                        <span>-$100.00</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <span>Shipping: Flat</span>--}}
{{--                                        <span>$10.00</span>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <span>Total</span>--}}
{{--                                        <span>$2034.11</span>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
