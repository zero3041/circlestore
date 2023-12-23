  @extends('admin.layout.layout')
 
  @section('content')
  <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0 text-dark">Bài viết</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Trang chủ</a></li>
	              <li class="breadcrumb-item active">Bài viết</li>
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
                <h3 class="card-title">Bài viết</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="@isset($page){{route('editPage',['id'=>$page['id_cms']])}}@endisset @empty($page){{route('addPage')}}@endempty" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tiêu đề</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" value="@isset($page['title']){{$page['title']}} @endisset" class="form-control" id="inputEmail3" placeholder="Tiêu đề bài viết">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung</label>
                    <div class="col-sm-10">
                     <textarea id="page-detail" name="page_description">@isset($page['description']){!!$page['description']!!} @endisset</textarea>
                        <script type="text/javascript">CKEDITOR.replace('page-detail',{
                          filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
                          });
                        </script>
                    </div>
                  </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hiển thị bài viết</label>
                      <div class="col-sm-10">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" id="customSwitch3" name="active" value="1" @isset($page['active']){{$page['active']==1?'checked':''}}  @endisset>
                          <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                      </div>
                  </div> 

                    </div>
                  <div class="card-footer">
                  <a type="submit" class="btn btn-default" href="{{ route('adminPage') }}">Thoát</a>
                  <button type="submit" class="btn btn-info float-right">Lưu</button> 
                </div> 
                  </div>
                </div>
                <!-- /.card-body -->
                 
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
  @endsection