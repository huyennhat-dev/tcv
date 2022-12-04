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
                        <li class="breadcrumb-item active">Danh sách tính cách nhân vật</li>
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
                            <h3 class="card-title">Bảng danh sách tính cách nhân vật</h3>
                        </div>
                        <!-- /.card-header -->
                        <div id="yyyy">
                            <div class="card-body">
                                @if (session('msg'))
                                <div class=" alert-form">
                                    <div id="toast-container" class="toast-top-right">
                                        <div class="alert toast toast-success" aria-live="polite">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <div class="toast-message"> {{ session('msg') }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <table class="table table-responsive table-hover" id="tbl_admin">
                                    <thead>
                                        <tr>
                                            <th class="w-30">STT</th>
                                            <th class="w-700">Tên tính cách nhân vật</th>
                                            <th class="w-250">Trạng thái</th>
                                            <th class="w-250">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($personality as $key => $val)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$val->tentinhcach}}</td>
                                            <td class="text-center ">
                                                @if($val->trangthai === 1)
                                                <div class="w-100px cursor-auto btn-sm btn-danger">Ẩn</div>
                                                @else
                                                <div class="w-100px cursor-auto btn-sm btn-success">Hiện</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="post" action="{{route('personality.destroy', [$val->id])}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có chắc muốn xóa không?')" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa
                                                        </button>
                                                    </form>

                                                    <a class="btn btn-primary btn-sm ml-2" href="{{route('personality.edit', [$val->id])}}">
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
                            <!-- /.card-body -->
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