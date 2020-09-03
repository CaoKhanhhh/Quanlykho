<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | DataTables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    @include('users.layout.css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/user/homepage.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('users.layout.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
   @include('users.layout.sidebar',['user'=>$user,'stock_user'=> $stock_user])

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
                                <div class="stock_inf">
                                    <div class="stock">
                                        <b>Kho:</b>
                                        @if ($stock)
                                            {{$stock->name}}
                                        @endif
                                    </div>
                                    <div class="manager">
                                        <b>Quản kho:</b>
                                        @if($user)
                                            {{$user->name}}
                                    </div>
                                    <button class="btn_addProduct" onclick="window.location.href='{{route('product.add',['stock'=> $stock->id,'id'=>$user->id])}}'">
                                        <i class="fa fa-plus"></i>
                                        Thêm sản phẩm
                                    </button>
                                    <button class="excel" onclick="window.location.href='{{route('product.export',['stock' => $stock->id,'user_id'=>$user->id])}}'">
                                        <i class="fas fa-download"></i>
                                        Xuất file excel
                                    </button>
                                </div>
                                @endif
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product as $key => $p)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$p->id}}</td>
                                                    <td>{{$p->name}}</td>
                                                    <td><img width="50px" height="auto" src="{{asset($p->image)}}"></td>
                                                    <td>
                                                        {{$p->number}}
                                                    </td>
                                                    <td>{{$p->price}}</td>
                                                    @if($p->status ==1)
                                                        <td>Còn hàng</td>
                                                    @else
                                                        <td>Hết hàng</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{route('product.edit',['user_id'=>$user->id,'id'=> $p->id,'stock'=>$stock->id])}}" class="product_edit">
                                                            <span><i class="fas fa-edit"></i></span>
                                                        </a>
                                                        <a href="javascript:void(0);" linkUrl="{{route('product.delete',['user_id'=>$user->id,'id'=> $p->id,'stock'=>$stock->id])}}" class="product_delete">
                                                            <span><i class="fas fa-minus-circle"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá bán</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="custom_paginate">
                                    {{$product->links()}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

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

@include('users.layout.script_link')
<!-- DataTables -->
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

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
    });
</script>
<script>
    $(document).ready(function (){
        $(".product_delete").click(function (){
            var url= $(this).attr('linkUrl');
            var r= confirm("Bạn có chắc chắn muốn xóa?");
            if(r){
                window.location.href=url;
            }
        })
    });
</script>
</body>
</html>
