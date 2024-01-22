<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CirCle Store</title>
    <link rel="stylesheet"  href="{{ asset('web/css/style.css') }}">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css') }}" rel="stylesheet">
    <link
        rel="stylesheet"
        href="{{ asset('https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css') }}"
    />
{{--    <link rel="stylesheet" href="{{ asset('web/css/bootstrap-grid.css') }}">--}}
    <!-- Main CSS File -->
{{--    <link rel="stylesheet" href="{{ asset('web/css/style1.css') }}">--}}
</head>
<body>
<div id="page" class="site page-category">

    <aside class="site-off desktop-hide">
        <div class="off-canvas">
            <div class="canvas-head flexitem">
                <div class="logo"><a href="#"><span class="circle"></span>.Store</a></div>
                <a href="#" class="t-close flexcenter"><i class="ri-close-line"></i></a>
            </div>
            <div class="departments"></div>
            <nav></nav>
            <div class="thetop-nav"></div>
        </div>
    </aside>

    <header>
        @include('web.partials.headerTop')
        <!-- header top -->
        @include('web.partials.headerNav')
        <!-- header nav -->
        @include('web.partials.headerMain')
        <!-- header main -->
    </header>
    <!-- Header -->
    <main>
        @yield('content')

    </main>
    <!-- Main -->
    <footer>
        @include('web.partials.footerNewsletter')
        <!-- newsletter -->
        @include('web.partials.footerWidgets')
        <!-- widgets -->
        @include('web.partials.footerInfo')
        <!-- footer info -->
    </footer>
    <!-- footer -->
    <div class="menu-bottom desktop-hide">
        <div class="container">
            <div class="wrapper">
                <nav>
                    <ul class="flexitem">
                        <li>
                            <a href="#">
                                <i class="ri-bar-chart-line"></i>
                                <span>Trending</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ri-user-6-line"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li>
                            <a href="#0">
                                <i class="ri-heart-line"></i>
                                <span>Wishlist</span>
                            </a>
                        </li>
                        <li>
                            <a href="#0" class="t-search">
                                <i class="ri-search-line"></i>
                                <span>Search</span>
                            </a>
                        </li>
                        <li>
                            <a class="cart-trigger">
                                <i class="ri-shopping-cart-line"></i>
                                <span>Cart</span>
                                <div class="fly-item">
                                    <span class="item-number">0</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- menu bottom -->
    <div class="search-bottom desktop-hide">
        <div class="container">
            <div class="wrapper">
                <form action="" class="search">
                    <a href="#" class="t-close search-close flexcenter"><i class="ri-close-line"></i></a>
                    <span class="icon-large"><i class="ri-mail-line"></i></span>
                    <input type="search" placeholder="Tim kiem" required>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- show search -->

    <!-- <div class="overlay"></div> -->
</div>

<script src="{{ asset('https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.3.1/index.js') }}"></script>
<script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('web/js/script.js') }}"></script>

{{--add to cart--}}
<script>
    $(document).ready(function() {
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();

            // Lấy ID sản phẩm từ data attribute
            var productId = $(this).closest('.productstore').data('product-id');
            // console.log(productId);

            // Gửi yêu cầu AJAX để thêm vào giỏ hàng
            $.ajax({
                type: 'POST',
                url: '/cart/' + productId,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message); // Hoặc hiển thị thông báo theo ý bạn
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                }
            });
        });
    });
</script>

{{--add wish list--}}

<script>
    $(document).ready(function() {
        $('.add-to-wishlist').on('click', function(e) {
            e.preventDefault();

            var productId = $(this).closest('.productstore').data('product-id');

            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/customer/wishlist/add',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 'success') {
                        var data = response.data;
                        console.log(data);
                        $('.fly-item').text(data);
                        alert('Sản phẩm đã được thêm vào danh sách yêu thích.');
                    } else if(response.status === 'error')
                    {
                        alert('Sản phẩm đã tồn tại trong danh sách yêu thích.');
                    }
                    else {
                        window.location = 'http://127.0.0.1:8000/login';
                    }
                },
                error: function(err) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    console.error(err);
                }
            });
        });
    });
</script>



<script>
    const FtoShow = '.filter';
    const Fpopup = document.querySelector(FtoShow);
    const Ftrigger = document.querySelector('.filter-trigger');

    Ftrigger.addEventListener('click', () => {
        setTimeout(() => {
            if (!Fpopup.classList.contains('show')) {
                Fpopup.classList.add('show');
            }
        }, 250)
    })

    //

    document.addEventListener('click', (e) => {
        const isClosest = e.target.closest(FtoShow);
        if (!isClosest && Fpopup.classList.contains('show')) {
            Fpopup.classList.remove('show');
        }
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mySwiper = new Swiper('.myslider', {
            // Các tùy chọn khác của Swiper
            loop: true, // Cho phép lặp lại các slide
            autoplay: {
                delay: 2000, // Thời gian trễ giữa các slide (milliseconds)
            },
        });
    });
</script>

<script>
    const qtyControls = document.querySelectorAll('.qty-control');

    qtyControls.forEach(qtyControl => {
        const minusButton = qtyControl.querySelector('.minus');
        const plusButton = qtyControl.querySelector('.plus');
        const inputField = qtyControl.querySelector('input');

        minusButton.addEventListener('click', (event) => {
            event.preventDefault();
            const currentValue = Number(inputField.value);
            if (currentValue > 1) {
                inputField.value = currentValue - 1;
            }
        });

        plusButton.addEventListener('click', (event) => {
            event.preventDefault();
            const currentValue = Number(inputField.value);
            inputField.value = currentValue + 1;
            // console.log('Giá trị hiện tại:', inputField.value);
        });
    });
</script>

<script>
    function updateRating(value) {
        // Cập nhật giá trị số sao vào trường input ẩn
        document.getElementById('ratingValue').value = value;
    }

</script>

<script>
    $(document).ready(function () {
        $('#applyDiscountBtn').on('click', function () {
            const voucherCode = $('#voucherCodeInput').val();

            $.ajax({
                type: 'POST',
                url: '/applyVoucher',
                data: {
                    _token: '{{ csrf_token() }}',
                    voucher_code: voucherCode
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        // Lỗi, hiển thị thông báo lỗi
                        alert(response.message);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.cancel-discount-btn').on('click', function () {
            var voucherCode = $(this).data('voucher-code');

            $.ajax({
                type: 'POST',
                url: '{{ route('cancel.discount') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'voucher_code': voucherCode,
                },
                success: function (data) {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            });
        });
    });
</script>

</body>
</html>
