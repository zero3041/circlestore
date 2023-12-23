@component('mail::message')
Xin chào, {{$customer->name}}.
<br>
Cảm ơn bạn đã mua hàng của chúng tôi!
<br>
<br>
Tổng số tiền thanh toán của bạn là:
<b>{{number_format($order->total_price_tax)}} VND  </b>
<br>
Dưới đây là thông tin chi tiết hóa đơn của bạn:
<br>

@component('mail::button', ['url' => route('pdf',['id' => $order->id_order])])
Xem hoá đơn
@endcomponent

Cảm ơn đã sử dụng dịch vụ của chúng tôi.<br>
@endcomponent
