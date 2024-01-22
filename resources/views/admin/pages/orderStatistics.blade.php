@extends('admin.layout.layout')

@section('content')
    <div class="container">
        <h1>Thống kê đơn hàng</h1>

        <p>Số lượng đơn hàng: {{ $totalOrders }}</p>
        <p>Tổng doanh thu: {{ number_format($totalRevenue) }}</p>

        <h2>Sản phẩm phổ biến</h2>
        <ul>
            @foreach ($popularProducts as $product)
                <li>{{ $product->product_name }}: {{ $product->total_quantity }} sản phẩm</li>
            @endforeach
        </ul>

        <h2>Đơn hàng theo trạng thái</h2>
        <ul>
            @foreach ($orderStatusCount as $status)
                <li>Trạng thái <span style="color:red">{{ $status->status }}</span> : {{ $status->count }} đơn hàng</li>
            @endforeach
        </ul>
    </div>
    <div class="container">
        <h1>Biểu đồ đơn hàng theo trạng thái</h1>

        <canvas id="orderStatusChart" width="800" height="400"></canvas>

        <script>
            var ctx = document.getElementById('orderStatusChart').getContext('2d');
            var data = {
                labels: {!! $labels !!},
                datasets: [{
                    label: 'Đơn hàng theo trạng thái',
                    data: {!! $data !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        </script>
    </div>
@endsection
