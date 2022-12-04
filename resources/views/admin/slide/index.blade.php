@extends('../layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách slide</li>
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
            <div class="row justify-content-center">
                <div class="col-12 col-sm-11 col-md-11">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bảng danh sách slide</h3>
                        </div>
                        <!-- /.card-header -->
                        <div id="xxxx">
                            <div class="card-body">
                                <table class="table table-responsive " id="tbl_admin">
                                    <thead>
                                        <tr>
                                            <th class="w-30">STT</th>
                                            <th class="w-500">Hình ảnh</th>
                                            <th class="w-250">Mô tả</th>
                                            <th class="w-150">Trạng thái</th>
                                            <th class="w-200">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($slide as $key => $val)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>
                                                <img class="w-500"  src="{{asset('public/uploads/slide/'.$val->hinhanh)}}" alt="">
                                            </td>
                                            <td>
                                                <p>{{$val->mota}}</p>
                                            </td>
                                            <td class="text-center">
                                                @if($val->trangthai === 1)
                                                <div class="cursor-auto btn-sm btn-danger">Ẩn</div>
                                                @else
                                                <div class="cursor-auto btn-sm btn-success">Hiện</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="post" action="{{route('slide.destroy', [$val->id])}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có chắc muốn xóa không?')" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa
                                                        </button>
                                                    </form>

                                                    <a class="btn btn-primary btn-sm ml-2" href="{{route('slide.edit', [$val->id])}}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Sửa
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection