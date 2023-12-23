@component('mail::message')

Chúc mừng bạn đã đăng ký tài khoản thành công
<br>
Tài khoản của bạn là: {{$email}}
<br>
Mật khẩu: {{$password}}
<br>
Nếu bạn muốn đăng nhập:
@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Đăng nhập tại đây
@endcomponent
<br>
Lưu ý, bạn vui lòng bảo mật thông tin này tránh mất tài khoản.


Cảm ơn đã sử dụng dịch vụ của chúng tôi.<br>
@endcomponent
