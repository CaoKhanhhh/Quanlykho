<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layout.css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/admin/quankho_add.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
  @include('admin.layout.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.layout.sidebar')

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
                                <h3 class="card-title">Thêm tài khoản</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Họ tên</label>
                                        <div class="validate-message">
                                            @error('name')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="Họ tên">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Ảnh đại diện</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" onchange="readUrl(this);" name="image" id="inputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        <img src="" id="avatar" style="margin: auto;display: block">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày sinh</label>
                                        <div class="validate-message">
                                            @error('date_of_births')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input type="date" class="form-control" name="date_of_births">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giới tính</label><br>
                                        <input type="radio" name="gender" value="1" checked>
                                        <label for="male">Nam</label><br>
                                        <input type="radio" name="gender" value="2">
                                        <label for="female">Nữ</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <div class="validate-message">
                                            @error('email')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <input type="text" name="email" class="form-control" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
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

@include('admin.layout.script_link')
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
