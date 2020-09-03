<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
   @include('admin.layout.css')
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
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if($user)
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Họ tên</label>
                                        <input type="text" name="name" class="form-control" placeholder="Họ tên" value="{{$user->name}}">
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
                                        <img src="{{asset($user->image)}}" id="avatar" width="100px" height="100px" style="margin: 3% 0 0 41%">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày sinh</label>
                                        <input type="date" class="form-control" name="date_of_births" value="{{$user->date_of_births}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giới tính</label><br>
                                        <input type="radio" name="gender" value="1"
                                               @if($user->gender==1) checked="true"
                                               @endif
                                        >
                                        <label for="male">Nam</label><br>
                                        <input type="radio" name="gender" value="2"
                                               @if($user->gender==2) checked="true"
                                               @endif
                                        >
                                        <label for="female">Nữ</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                                </div>
                            </form>
                            @endif
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
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>
