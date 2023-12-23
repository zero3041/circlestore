  @extends('admin.layout.layout')

  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Sản phẩm</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Sản phẩm</li>
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
        <h3 class="card-title">Thêm sản phẩm mới</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form class="form-horizontal saveProduct" action="@isset($product){{route('editProduct',['id'=>$product['id_product']])}}@endisset @empty($product){{route('addProduct')}}@endempty" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="getAPI" class="getAPI" value="{{ asset('') }}">
        <input type="hidden" name="product" class="productID" value="@isset($product){{$product['id_product']}}@endisset">
        <div class="card-body">
        <div class="row mt-4" style="margin-top: 0px !important">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Cài đặt cơ bản</a>
              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Thông số</a>
              <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Danh mục</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent" style="width: 100%">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" value="@isset($product['name']){{$product['name']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" required="">
                      </div>
                    </div>
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Giá Nhập</label>
                          <div class="col-sm-10">
                              <input type="text" name="cost" value="@isset($product['cost']){{$product['cost']}} @endisset" class="form-control" id="inputEmail3" placeholder="Giá nhập vào" required="">
                          </div>
                      </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Giá chưa thuế</label>
                      <div class="col-sm-4">
                        <input type="text" name="price" value="@isset($product['price']){{$product['price']}} @endisset" class="form-control" id="inputEmail3" placeholder="Giá bán chưa có thuế" required="">
                      </div>
                      <div class="form-group col-sm-6">
                        <select class="custom-select tax-option col-sm-5" name="tax">
                          <option data="0" value="0">Không thuế</option>
                          @isset ($tax)
                            @forelse ($tax as $arr)
                                <option data="{{$arr['value']}}" value="{{$arr['id_tax']}}" @isset($product['id_tax']){{$arr['id_tax']==$product['id_tax']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Giá bao gồm thuế</label>
                      <div class="col-sm-4">
                        <input type="text" name="price_tax" value="@isset($product['price_tax']){{$product['price_tax']}} @endisset" class="form-control" id="inputEmail3" placeholder="Giá bán đã bao gồm thuế" disabled="">
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Khuyến mãi</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input sale" id="customSwitch2" name="sale" value="1" @isset($product['on_sale']) {{$product['on_sale']!=0?'checked':''}} @endisset>
                          <label class="custom-control-label" for="customSwitch2">Bật nếu bạn muốn khuyến mãi sản phẩm này</label>
                        </div>
                      </div>
                  </div>
                  <div class="on_sale d-none"  @isset($product['on_sale']){!!$product['on_sale']!=0?'style="display: block !important"':'style="display: none"'!!} @endisset>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Phần trăm khuyến mãi</label>
                      <div class="col-sm-4">
                        <input type="text" name="percentPrice" value="@isset($product['on_sale']){{$product['on_sale']!=0?$product['on_sale']:1}} @endisset" class="form-control percentPrice" id="inputEmail3" placeholder="Nhập số phần trăm mà bạn muốn khuyến mãi" required="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Giá đã khuyến mãi</label>
                      <div class="col-sm-4">
                        <input type="text" name="price_sale" value="@isset($product['price_sale']){{$product['price_sale']}} @endisset" class="form-control price-sale" id="inputEmail3" placeholder="Giá sản phẩm sau khi khuyến mãi" disabled="">
                      </div>
                    </div>
                  </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">@if (!isset($product))Số lượng @else Số lượng thêm vào @endif</label>
                      <div class="col-sm-4">
                        <input type="text" name="quantity" value="0" class="form-control" id="inputEmail3" placeholder="Số lượng sản phẩm" required="" min="0">@isset($product['quantity'])Số lượng cũ: {{$product['quantity']}} @endisset
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Sản phẩm nổi bật</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch1" name="hotProduct" value="1" @isset($product['hot']) {{$product['hot']==1?'checked':''}} @endisset>
                          <label class="custom-control-label" for="customSwitch1">Bật nếu bạn muốn hiển thị ở sản phẩm nổi bật</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                      <div class="col-sm-10">
                      <textarea id="product-detail-short" name="product_detail_short">@isset($product['description_short']){!!$product['description_short']!!} @endisset</textarea>
                        <script type="text/javascript">CKEDITOR.replace('product-detail-short',{
                          filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                          });
                        </script>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Chi tiết</label>
                      <div class="col-sm-10">
                        <textarea id="product-detail" name="product_detail">@isset($product['description']){!!$product['description']!!} @endisset</textarea>
                        <script type="text/javascript">CKEDITOR.replace('product-detail',{
                          filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                          });
                        </script>
                        @include('ckfinder::setup')
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tình trạng sản phẩm</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($product['active']) {{$product['active']==1?'checked':''}} @endisset>
                          <label class="custom-control-label" for="customSwitch3">Hiển thị</label>
                        </div>
                      </div>
                  </div>
                    <div class="form-group row">
                    <label for="exampleInputFile" class="col-sm-2 col-form-label">Ảnh sản phẩm</label>
                    <div class="col-sm-10 add-select-image">
                      @if (isset($image))
                      @foreach ($image as $key => $value)
                        <div class="row form-group">
                          <div class="col-sm-6">
                            <img src="{{ asset('upload/product').'/'.$value['url'] }}" data="{{$value['id_image']}}" width="150px" class="check_image">
                          </div>
                          <div class="col-sm-6 row">
                            <div class="col-sm-6">
                              <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="cover{{$key+1}}" name="cover" @if($value['cover']==1) checked="" @endif value="{{$key+1}}_{{$value['id_image']}}">
                          <label for="cover{{$key+1}}" class="custom-control-label">Ảnh chính</label>
                        </div>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(this);">
                                <i class="fa fa-trash"></i> Xóa</button>
                            </div>
                          </div>
                      </div>
                      @endforeach

                      @else
                        <div class="row form-group">
                          <div class="col-sm-6">
                            <input type="file" name="image[]" class="check_image">
                          </div>
                          <div class="col-sm-6 row">
                            <div class="col-sm-6">
                              <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="cover1" name="cover" checked="" value="1">
                          <label for="cover1" class="custom-control-label">Ảnh chính</label>
                        </div>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(this);">
                                <i class="fa fa-trash"></i> Xóa</button>
                            </div>
                          </div>
                      </div>
                      @endif

                    </div>


                  </div>
                   <div class="form-group row">
                    <div class="col-sm-2 offset-sm-2">
                      <button type="button" onclick="addImage()" class="btn btn-default" style="margin-left: 7px"><i class="fas fa-plus"></i> Thêm ảnh tiếp</button>
                    </div>
                    <div class="add-image" hidden>
                      <div class="row form-group">
                        <div class="col-sm-6">
                          <input type="file" name="image[]" disabled="disabled" class="check_image">
                        </div>
                        <div class="col-sm-6 row">
                            <div class="col-sm-6">
                              <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="cover" name="cover" value="">
                          <label for="cover" class="custom-control-label">Ảnh chính</label>
                        </div>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(this);">
                                <i class="fa fa-trash"></i> Xóa</button>
                              </div>
                          </div>
                      </div>
                    </div>
                    <input type="hidden" value="1" name="totalImage" class="totalImage">
                   </div>
                </div>

                </div>
            </div>
            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                      <div class="col-sm-5">
                        <select class="custom-select" name="manufacturer">
                          @isset ($manufacturer)
                            @forelse ($manufacturer as $arr)
                                <option value="{{$arr['id_manufacturer']}}" @isset($product){{$arr['id_manufacturer']==$product['id_manufacturer']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Thông số sản phẩm</label>
                      <div class="col-sm-10 add-product-param-select">

                        @if(isset($feature_products))
                            @foreach ($feature_products as $key => $feature_product)
                            <div class="row form-group product-param-selected">
                              <div class="col-sm-6">
                        <select class="custom-select feature" name="productParam[]" onchange="getFeatureValue(this)">
                          @isset ($feature)
                            @forelse ($feature as $arr)
                                <option value="{{$arr['id_feature']}}" @isset($feature_product){{$arr['id_feature']==$feature_product['id_feature']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>

                      </div>
                      <div class="col-sm-4">
                          <select class="custom-select featureValue" name="productValue[]">
                          @isset ($feature_value_product)
                            @forelse ($feature_value_product[$key] as $arr)
                                <option value="{{$arr['id_feature_value']}}" @isset($feature_product){{$arr['id_feature_value']==$feature_product['id_feature_value']?'selected':''}}@endisset>{{$arr['value']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>
                        </div>
                        <div class="col-sm-2"><button class="btn btn-danger" type="button" onclick="deleteProductParam(this,1);"><i class="fa fa-trash"></i> Xoá</button></div>
                      </div>
                            @endforeach
                        @else
                        <div class="row form-group product-param-selected">
                          <div class="col-sm-6">
                        <select class="custom-select feature" name="productParam[]" onchange="getFeatureValue(this)">
                          @isset ($feature)
                            @forelse ($feature as $arr)
                                <option value="{{$arr['id_feature']}}" @isset($attrbuteValue){{$arr['id_attribute_group']==$attrbuteValue['id_attribute_group']?'selected':''}}@endisset>{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>

                      </div>
                      <div class="col-sm-4">
                          <select class="custom-select featureValue" name="productValue[]">
                          @isset ($feature_value)
                            @forelse ($feature_value as $arr)
                                <option value="{{$arr['id_feature_value']}}" @isset($attrbuteValue){{$arr['id_attribute_group']==$attrbuteValue['id_attribute_group']?'selected':''}}@endisset>{{$arr['value']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>
                        </div>
                        <div class="col-sm-2"><button class="btn btn-danger" type="button" onclick="deleteProductParam(this);"><i class="fa fa-trash"></i> Xoá</button></div>
                      </div>
                        @endif


                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 offset-sm-2">
                    <button type="button" onclick="addProductParam()" class="btn btn-default" style="margin-left: 7px"><i class="fas fa-plus"></i> Thêm thông số</button>
                  </div>
                  <div class="add-product-param" hidden>
                      <div class="row form-group product-param-selected">
                        <div class="col-sm-6">
                        <select class="custom-select feature" name="productParam[]" disabled="disabled" onchange="getFeatureValue(this);">
                          @isset ($feature)
                            @forelse ($feature as $arr)
                                <option value="{{$arr['id_feature']}}">{{$arr['name']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>

                      </div>
                      <div class="col-sm-4">
                          <select class="custom-select featureValue" name="productValue[]" disabled="disabled">
                          @isset ($feature_value)
                            @forelse ($feature_value as $arr)
                                <option value="{{$arr['id_feature_value']}}">{{$arr['value']}}</option>
                                @empty
                            @endforelse
                          @endisset

                        </select>
                        </div>
                        <div class="col-sm-2"><button class="btn btn-danger" type="button" onclick="deleteProductParam(this);"><i class="fa fa-trash"></i> Xoá</button></div>
                      </div>
                    </div>
                    <input type="hidden" value="1" name="totalProductParam" class="totalImage">
                </div>
            </div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Sản phẩm thuộc danh mục</label>
                <div class="col-sm-10">
                  @include('admin.partials.categoryTree')
                </div>
              </div>
             </div>
          </div>
        </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        	<a type="submit" class="btn btn-default" href="{{ route('adminProduct') }}">Cancel</a>
         	<button type="submit" class="btn btn-info float-right">Lưu</button>

        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
  @endsection
