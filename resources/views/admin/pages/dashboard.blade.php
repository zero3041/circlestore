  @extends('admin.layout.layout')

  @section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{!! $totalOrders !!}</h3>

                <p>Hóa đơn</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
{{--          <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-success">--}}
{{--              <div class="inner">--}}
{{--                <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

{{--                <p>Lượt đánh giá</p>--}}
{{--              </div>--}}
{{--              <div class="icon">--}}
{{--                <i class="ion ion-stats-bars"></i>--}}
{{--              </div>--}}
{{--              <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{!! $totalCustomer !!}</h3>

                <p>Người dùng</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Chi tiết<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{!! number_format($totalRevenue) !!}</h3>

                <p>Doanh thu</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-5 col-6" style="width: 600px" class="">
                <h2>Biểu đồ Sản phẩm phổ biến</h2>
                <canvas style="width: 400px!important;" id="popularProductsChart" width="800" height="400"></canvas>
                <script>
                    var ctx = document.getElementById('popularProductsChart').getContext('2d');
                    var data = {
                        labels: {!! json_encode($popularProducts->pluck('product_name')) !!},
                        datasets: [{
                            data: {!! json_encode($popularProducts->pluck('total_quantity')) !!},
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

                    var myDoughnutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                        options: options
                    });
                </script>
            </div>
            <div class="col-lg-5 col-6" style="width: 700px;margin-left: 100px" class="">
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
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
{{--        <div class="row">--}}
{{--          <!-- Left col -->--}}
{{--          <section class="col-lg-7 connectedSortable">--}}
{{--            <!-- Calendar -->--}}
{{--            <div class="card bg-gradient-success">--}}
{{--              <div class="card-header border-0">--}}

{{--                <h3 class="card-title">--}}
{{--                  <i class="far fa-calendar-alt"></i>--}}
{{--                  Lịch--}}
{{--                </h3>--}}
{{--                <!-- tools card -->--}}
{{--                <div class="card-tools">--}}
{{--                  <!-- button with a dropdown -->--}}
{{--                  <div class="btn-group">--}}
{{--                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">--}}
{{--                      <i class="fas fa-bars"></i></button>--}}
{{--                    <div class="dropdown-menu float-right" role="menu">--}}
{{--                      <a href="#" class="dropdown-item">Add new event</a>--}}
{{--                      <a href="#" class="dropdown-item">Clear events</a>--}}
{{--                      <div class="dropdown-divider"></div>--}}
{{--                      <a href="#" class="dropdown-item">View calendar</a>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">--}}
{{--                    <i class="fas fa-times"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--                <!-- /. tools -->--}}
{{--              </div>--}}
{{--              <!-- /.card-header -->--}}
{{--              <div class="card-body pt-0">--}}
{{--                <!--The calendar -->--}}
{{--                <div id="calendar" style="width: 100%"></div>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}
{{--            <!-- Map card -->--}}
{{--            <div class="card bg-gradient-primary">--}}
{{--              <div class="card-header border-0">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-map-marker-alt mr-1"></i>--}}
{{--                  Địa điểm--}}
{{--                </h3>--}}
{{--                <!-- card tools -->--}}
{{--                <div class="card-tools">--}}
{{--                  <button type="button"--}}
{{--                          class="btn btn-primary btn-sm daterange"--}}
{{--                          data-toggle="tooltip"--}}
{{--                          title="Date range">--}}
{{--                    <i class="far fa-calendar-alt"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button"--}}
{{--                          class="btn btn-primary btn-sm"--}}
{{--                          data-card-widget="collapse"--}}
{{--                          data-toggle="tooltip"--}}
{{--                          title="Collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--                <!-- /.card-tools -->--}}
{{--              </div>--}}
{{--              <div class="card-body">--}}
{{--                <div id="world-map" style="height: 250px; width: 100%;"></div>--}}
{{--              </div>--}}
{{--              <!-- /.card-body-->--}}
{{--              <div class="card-footer bg-transparent">--}}
{{--                <div class="row">--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-1"></div>--}}
{{--                    <div class="text-white">Visitors</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-2"></div>--}}
{{--                    <div class="text-white">Online</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <div id="sparkline-3"></div>--}}
{{--                    <div class="text-white">Sales</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                </div>--}}
{{--                <!-- /.row -->--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}


{{--            <!-- DIRECT CHAT -->--}}

{{--            <!--/.direct-chat -->--}}

{{--            <!-- TO DO List -->--}}

{{--            <!-- /.card -->--}}
{{--          </section>--}}

{{--          <!-- /.Left col -->--}}
{{--          <!-- right col (We are only adding the ID to make the widgets sortable)-->--}}
{{--          <section class="col-lg-5 connectedSortable">--}}
{{--            <!-- solid sales graph -->--}}
{{--            <div class="card bg-gradient-info">--}}
{{--              <div class="card-header border-0">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-th mr-1"></i>--}}
{{--                  Biểu đồ--}}
{{--                </h3>--}}

{{--                <div class="card-tools">--}}
{{--                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">--}}
{{--                    <i class="fas fa-minus"></i>--}}
{{--                  </button>--}}
{{--                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">--}}
{{--                    <i class="fas fa-times"></i>--}}
{{--                  </button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="card-body">--}}
{{--                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
{{--              </div>--}}
{{--              <!-- /.card-body -->--}}
{{--              <div class="card-footer bg-transparent">--}}
{{--                <div class="row">--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">Mail-Orders</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">Online</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                  <div class="col-4 text-center">--}}
{{--                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"--}}
{{--                           data-fgColor="#39CCCC">--}}

{{--                    <div class="text-white">In-Store</div>--}}
{{--                  </div>--}}
{{--                  <!-- ./col -->--}}
{{--                </div>--}}
{{--                <!-- /.row -->--}}
{{--              </div>--}}
{{--              <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}
{{--            <!-- Custom tabs (Charts with tabs)-->--}}
{{--            <div class="card">--}}
{{--              <div class="card-header">--}}
{{--                <h3 class="card-title">--}}
{{--                  <i class="fas fa-chart-pie mr-1"></i>--}}
{{--                  Giảm giá--}}
{{--                </h3>--}}
{{--                <div class="card-tools">--}}
{{--                  <ul class="nav nav-pills ml-auto">--}}
{{--                    <li class="nav-item">--}}
{{--                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>--}}
{{--                    </li>--}}
{{--                  </ul>--}}
{{--                </div>--}}
{{--              </div><!-- /.card-header -->--}}
{{--              <div class="card-body">--}}
{{--                <div class="tab-content p-0">--}}
{{--                  <!-- Morris chart - Sales -->--}}
{{--                  <div class="chart tab-pane active" id="revenue-chart"--}}
{{--                       style="position: relative; height: 300px;">--}}
{{--                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
{{--                  </div>--}}
{{--                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">--}}
{{--                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div><!-- /.card-body -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}





{{--          </section>--}}
{{--          <!-- right col -->--}}
{{--        </div>--}}
        <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    @endsection
