@extends('../account')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('library')}}">Home</a></li>
                        <li class="breadcrumb-item active">Thông Báo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông Báo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="card-body">
                                <table class="table border">
                                    <tbody>
                                        <tr>
                                            <td width="100">
                                                <div>
                                                    <img class="img-circle" src="https://static.cdnno.com/user/b5a5e2e8958e765c2822d5cf7c60df7d/50.jpg?t=1592316927" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="" class="text-primary">
                                                        Toàn Cầu Tiến Nhập Đại Hồng Thủy Thời Đại vừa thêm 4 chương mới
                                                    </a>
                                                </div>
                                                <div>
                                                    21 giờ trước
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100">
                                                <div>
                                                    <img class="img-circle" src="https://static.cdnno.com/user/b5a5e2e8958e765c2822d5cf7c60df7d/50.jpg?t=1592316927" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="" class="text-primary">
                                                        Toàn Cầu Tiến Nhập Đại Hồng Thủy Thời Đại vừa thêm 4 chương mới
                                                    </a>
                                                </div>
                                                <div>
                                                    21 giờ trước
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100">
                                                <div>
                                                    <img class="img-circle" src="https://static.cdnno.com/user/b5a5e2e8958e765c2822d5cf7c60df7d/50.jpg?t=1592316927" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="" class="text-primary">
                                                        Toàn Cầu Tiến Nhập Đại Hồng Thủy Thời Đại vừa thêm 4 chương mới
                                                    </a>
                                                </div>
                                                <div>
                                                    21 giờ trước
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100">
                                                <div>
                                                    <img class="img-circle" src="https://static.cdnno.com/user/b5a5e2e8958e765c2822d5cf7c60df7d/50.jpg?t=1592316927" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="" class="text-primary">
                                                        Toàn Cầu Tiến Nhập Đại Hồng Thủy Thời Đại vừa thêm 4 chương mới
                                                    </a>
                                                </div>
                                                <div>
                                                    21 giờ trước
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-center">
                                <button id="btnLoadMoreNotification" class="col-md-4 col-md-offset-4 btn btn-default">HIỂN THỊ THÊM</button>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection