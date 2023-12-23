@component('mail::message')
    Xin chào: {{$name}},
    <br>
    Bạn vừa yêu cầu khôi phục mật khẩu tại hệ thống của chúng tôi.
    <br>
    Liên kết để đổi mật khẩu tại đây:
    @component('mail::button', ['url' => $linkReset])
        Đổi mật khẩu
    @endcomponent
    <br>
    <br>
    Lưu ý, nếu bạn không yêu cầu nội dung này, hãy truy cập ngay hệ thống và đổi mật khẩu để bảo vệ tài khoản.

    Cảm ơn đã sử dụng dịch vụ của chúng tôi.
@endcomponent
