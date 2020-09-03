<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/user/product.css') }}">
    @include('users.layout.css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('users.layout.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
   @include('users.layout.sidebar',['user'=>$user,'stock_user'=>$stock_user])

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8 offset-md-2 ">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{route('product.update')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name='id' value="{{$id}}">
                                <input type="hidden" name='user_id' value="{{$user->id}}">
                                <input type="hidden" name="stock" value="{{$stock}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" value="{{$product_detail->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Hình ảnh</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" onchange="readUrl(this);" name="image" id="inputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <img src="{{asset($product_detail->image)}}" id="avatar" class="image_product">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng</label>
                                        <input type="number" class="form-control" name="number" value="{{$product_detail->number}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá bán</label><br>
                                        <input type="number" class="form-control" name="price" value="{{{$product_detail->price}}}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('users.layout.script_link')
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
<script>
    function readUrl(input){
        if(input.files && input.files[0]){
            var reader =new FileReader();
            reader.onload =function (e){
                $('#avatar').attr('src',e.target.result).width(100).height(100);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>

