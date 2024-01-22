@extends('admin.layout.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Flash Sale</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Flash Sale</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h3 class="card-title col-lg-6">Danh sách sản phẩm Flash Sale</h3>
                <div class="col-lg-6">
                    <div class="float-right">
                        <a class="btn btn-block btn-info" href="{{ route('addAdminFlashSale') }}"><i class="fas fa-plus-circle"></i> Thêm mã sản phẩm Flash Sale</a>
                    </div>
                    {{-- <div class="float-right" style="padding-right: 10px;">
                    <a class="btn btn-block btn-info" href="{{ route('addCategory') }}"><i class="fas fa-plus-circle"></i> Thêm mới thuộc tính</a>
                  </div> --}}

                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>ID Sản phẩm</th>
                    <th>Giá giảm flash sale</th>
                    <th>Ngày kết thúc</th>
                    <th style="width: 100px;text-align: center;">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flash as $value)
                    <tr>
                        <td>{{$value['id']}}</td>
                        <td>{{$value['product_id']}}</td>
                        <td>{{$value['discount_price']}}</td>
                        <td>{{$value['end_date']}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger" onclick="return confirm('Bạn có muốn xoá không?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <div class="float-right">
                {{--                {{$category->onEachSide(3)->links('pagination::bootstrap-4')}}--}}
            </div>
        </div>
    </div>
    <!-- /.card -->
    <!-- /.content -->



@endsection
