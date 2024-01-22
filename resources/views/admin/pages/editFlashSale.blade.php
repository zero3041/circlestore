@extends('admin.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm mã giảm giá</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Mã giảm giá</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        <div class="">{{$err}}</div>
                    @endforeach
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Thêm mã giảm giá mới</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal saveProduct" action=" @isset($voucher) {{ route('postEditVoucher',['id'=>$voucher['id']]) }} @endisset @empty($voucher) {{route('postAddAdminFlashSale')}}  @endempty " method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="getAPI" class="getAPI" value="{{ asset('') }}">
            <input type="hidden" name="product" class="productID" value="">
            <div class="card-body">
                <div class="row mt-4" style="margin-top: 0px !important">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Cài đặt cơ bản</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent" style="width: 100%">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                                        <div class="col-sm-5">
                                            <select class="custom-select" name="id_product">
                                                @isset ($products)
                                                    @forelse ($products as $arr)
                                                        <option value="{{$arr['id_product']}}" @isset($product){{$arr['id_product']==$product['id_product']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                                    @empty
                                                    @endforelse
                                                @endisset

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Giá Giảm Flash Sale</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="discount_price" value="@isset($voucher) {{$voucher['code']}}  @endisset" class="form-control" id="inputCode" placeholder="Nhập mã giảm giá" required="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="end_date" value="@isset($voucher){{$voucher['end_date']}}@endisset" class="form-control" id="inputEndDate" required="">
                                        </div>
                                    </div>

{{--                                                                        <div class="form-group row">--}}
{{--                                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Trạng thái</label>--}}
{{--                                                                            <div class="col-sm-10">--}}
{{--                                                                                <select name="status" class="form-control" id="inputStatus">--}}
{{--                                                                                    <option value="active">Active</option>--}}
{{--                                                                                    <option value="inactive">Inactive</option>--}}
{{--                                                                                    <option value="expired">Expired</option>--}}
{{--                                                                                </select>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

{{--                                                                        <div class="form-group row">--}}
{{--                                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Lượt sử dụng</label>--}}
{{--                                                                            <div class="col-sm-10">--}}
{{--                                                                                <input type="number" name="used_count" value="0" class="form-control" id="inputUsedCount" >--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a type="submit" class="btn btn-default" href="">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Lưu</button>

            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->
@endsection
