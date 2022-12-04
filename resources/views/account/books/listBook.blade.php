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
                        <li class="breadcrumb-item active">Danh Sách Truyện</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tbl_account" class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th class="w-130">STT</th>
                                        <th class="w-500">Tên Truyện</th>
                                        <th class="w-150">Trạng Thái</th>
                                        <th class="w-500">Chương Mới Nhất</th>
                                        <th class="w-150">Thời Gian </th>
                                        <th class="w-200">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($truyen as $key => $val)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="book_name">
                                            <a href="{{route('book.edit', [$val->id])}}" class="text-primary fz-18 ">{{$val->tentruyen}}</a>
                                        </td>
                                        <td>
                                            <p class="text-secondary fz-18">
                                                @if($val->trangthai == 0)
                                                Chờ xuất bản
                                                @else
                                                Đã xuất bản
                                                @endif,
                                                @if($val->tinhtrang == 0)
                                                Đang ra
                                                @elseif($val->tinhtrang == 1)
                                                Hoàn thành
                                                @else
                                                Dừng viết
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-secondary fz-18 ">
                                                @if($chuongmoi[$key])
                                                {{$chuongmoi[$key]->tenchuong}}
                                                @else
                                                Không có chương
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-secondary fz-18">{{$val->thoigiancapnhat}}</p>
                                        </td>
                                        <td class="text-center ">
                                            <div class="d-flex">
                                                <a href="{{URL::to('account/book/'.$val->id.'/chapter/create')}}" class="btn btn-sm btn-outline-info btn-circle  ">
                                                    <i style="font-weight: bold;" class="ti-plus">
                                                    </i></a>
                                                <a href="{{route('book.edit', [$val->id])}}" class="btn btn-sm btn-outline-warning btn-circle ml-2">
                                                    <i style="font-weight: bold;" class="ti-pencil-alt">
                                                    </i></a>
                                                <a href="{{URL::to('account/book/'.$val->id.'/chapter/index')}}" class="btn btn-sm btn-outline-primary btn-circle  ml-2">
                                                    <i style="font-weight: bold;" class="ti-list-ol">
                                                    </i></a>
                                                <a href="#" class="btn btn-sm btn-outline-success btn-circle ml-2">
                                                    <i style="font-weight: bold;" class="ti-comment"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection