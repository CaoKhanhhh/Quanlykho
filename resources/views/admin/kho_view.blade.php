<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | DataTables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{URL::asset('assets/css/admin/kho_view.css')}}">
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
                        <h1>Quản lý kho</h1>
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
                                <h3 class="card-title">Danh sách quản kho </h3>
                            </div>

                            <div class="stock_select">
                                <div class="stock">
                                    <b>Chọn kho: </b>
                                    <select class="stock_option"id="stock">
                                        @foreach($stock as $key => $st)
                                            <option name="option_id" value="{{$st->id}}">{{$st->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="user">
                                        <b>Quản kho :</b>
                                        <div class="user_assign">
                                            @if($user)
                                                @include('admin.selectQuankho')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn-add_kho" id="btn-dropdown">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        Tạo kho
                                    </button>
                                    <div class="dropdown-content">
                                        <form role="form" method="post" action="" class="">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tên kho</label>
                                                    <input type="text" name="stock_name" style="height:35px;width:92%" class="form-control" placeholder="Nhập tên kho">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quản kho</label>
                                                    <div class="assignQuankho">
                                                        @include('admin/form_assignQuankho')
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn-sm btn-primary">Tạo kho</button>
                                                <button type="button" class="btn-sm cancel">Cancel</button>
                                            </div>
                                        </form>
{{--                                        <img src="data:image/jpeg;base64,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">--}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @include('admin/product')
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="custom-paginate_admin">{{$product->links()}}</div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
        $('#stock').click(function () {
            var val= $("#stock option:selected").attr('value');
            getDataTable(val);
            getDataUser(val);
        })
        function getDataTable(val){
            $.ajax({
                url:'/admin/kho?id='+val,
                type:"get",
                dataType:"html",
            }).done(function (data){
                $("tbody").empty().html(data);
            });
        }
        function getDataUser(val){
            $.ajax({
                url:'/admin/kho?user='+val,
                type:"get",
                dataType:"html",
            }).done(function (data){
                $(".user_assign").empty().html(data);
            });
        }
        $('#btn-dropdown').click(function (){
            $('.dropdown-content').show();
            $.ajax({
               url:'/admin/kho/getquankho',
               type: "get",
               dataType: "html",
            }).done(function (data){
               $('.assignQuankho').empty().html(data);
            });
        });
        $(".cancel").click(function() {
            $('.dropdown-content').hide();
        })
    });
</script>
@include('admin.layout.sidebar_script')
</body>
</html>
