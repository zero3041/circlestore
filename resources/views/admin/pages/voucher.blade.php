@extends('admin.layout.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Mã giảm giá</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Mã giảm giá</li>
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
                <h3 class="card-title col-lg-6">Danh sách mã giảm giá</h3>
                <div class="col-lg-6">
                    <div class="float-right">
                        <a class="btn btn-block btn-info" href="{{ route('addAdminVoucher') }}"><i class="fas fa-plus-circle"></i> Thêm mã giảm giá</a>
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
                    <th>Tên mã giảm giá</th>
                    <th>Code</th>
                    <th>Giảm giá</th>
                    <th>Điều kiện sử dụng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
{{--                    <th>Danh mục sản phẩm áp dụng</th>--}}
{{--                    <th>Sản phẩm áp dụng</th>--}}
                    <th>Số lượng</th>
                    <th style="width: 100px;text-align: center;">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($voucher as $key=>$value)
                    <tr>
                        <td>{{$value['id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['code']}}</td>
                        <td>{{$value['discount']}}</td>
                        <td>{{$value['condition']}}</td>
                        <td>{{$value['start_date']}}</td>
                        <td>{{$value['end_date']}}</td>
                        <td>{{$value['quantity']}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('editVoucher',['id'=>$value['id']])}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger" onclick="return confirm('Nếu bạn xóa thì danh mục con của danh mục này cũng sẽ bị xóa?')"><i class="fas fa-trash"></i></a>
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
