<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Simple Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{URL::asset('assets/css/admin/quanlykho_view.css')}}">
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
                        <h1>Quản lý quản kho</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách quản kho</h3>
                                @if(session('message'))
                                    <div class="callback_message">{{session('message')}}</div>
                                @endif
                                    <div class="card-tools">
                                        <form method="get">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                                    <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            <!-- /.card-header -->
                            <form method="post" action="{{route('quankho.resetPassword')}}">
                                @csrf
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                        <tr>
                                            <th><input id="checkAllUser" onclick="checkAll(this)" type="checkbox"></th>
                                            <th>Stt</th>
                                            <th>ID</th>
                                            <th>Quản kho</th>
                                            <th>Ảnh</th>
                                            <th>Ngày sinh</th>
                                            <th>Giới tính</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $key =>$u)
                                            <tr>
                                                <td><input id="checkUser" name="checkbox[]" value="{{$u->id}}" type="checkbox" onchange="showButton(this)"></td>
                                                <td>{{$key+1}}</td>
                                                <td>{{$u->id}}</td>
                                                <td>{{$u->name}}</td>
                                                <td><img src="{{asset($u->image)}}" width="50px"height="50px" alt=""></td>
                                                <td>{{$u->date_of_births}}</td>
                                                @if ($u->gender ==1 )
                                                    <td>Nam</td>
                                                @endif
                                                @if ($u->gender ==2)
                                                    <td>Nữ</td>
                                                @endif
                                                <td>{{$u->email}}</td>
                                                <td>
                                                    <a href="{{route('quankho.edit',['id'=> $u->id])}}" class="icon-edit">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" linkUrl="{{route('quankho.delete',['id'=> $u->id])}}" class="icon-delete">
                                                        <span><i class="far fa-trash-alt"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="footer_table">
                                    <button type="button" onclick="window.location.href='{{route('quankho.export')}}'" class="btn_excel">
                                        Xuất file excel
                                    </button>
                                    <button type="button" onclick="window.location.href='{{route('quankho.add')}}'" class="btn_addquankho">
                                        Tạo quản kho
                                    </button>
                                    <button type="submit" class="btn_resetpass" style="display: none">
                                        Reset mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
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
{{--@include('admin.layout.script');--}}
<script>
    $(document).ready(function (){
        $(".icon-delete").click(function (){
            var url= $(this).attr('linkUrl');
            var r= confirm("Bạn có chắc chắn muốn xóa?");
            if(r){
                window.location.href=url;
            }
        })
        var checkboxes =  $("[name='checkbox[]']");
        for (var i = 0; i < checkboxes.length; i++){
            checkboxes[i].checked = false;
        }
    });
    function checkAll(all){
        var checkboxes =  $("[name='checkbox[]']");
        for (var i = 0; i < checkboxes.length; i++){
            checkboxes[i].checked = all.checked;
        }
        if(all.checked ==true){
            $(".btn_resetpass").show();
        }
        else{
            $(".btn_resetpass").hide();
        }
    }
    function showButton(check){
        if(check.checked == true){
            $(".btn_resetpass").show();
        }
        else{
            $(".btn_resetpass").hide();
        }
    }
</script>
@include('admin.layout.sidebar_script')
</body>
</html>

