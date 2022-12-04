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
                        <li class="breadcrumb-item"><a href="{{route('book.index')}}">{{$truyen->tentruyen}}</a></li>
                        <li class="breadcrumb-item active">Danh Sách Chương</li>
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
                            <nav class="book_nav">
                                <ul class="d-flex m-0 p-0">
                                    <li class=" w-20 bg-light cur-poi border-right-3 border-white  ">
                                        <a href="{{URL::to('/account/book/'.$truyen->id.'/edit')}}" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div>
                                                <i class="nav-icon ti-check-box"></i>
                                            </div>
                                            <div class="ml-1 active_none">
                                                CHỈNH SỬA
                                            </div>
                                        </a>
                                    </li>
                                    <li class="w-20 bg-light cur-poi border-right-3 border-white active">
                                        <a href="{{URL::to('account/book/'.$truyen->id.'/chapter/index')}}" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div class="pt-2px">
                                                <i class="nav-icon ti-menu-alt"></i>
                                            </div>
                                            <div class="ml-1 active_none">
                                                D.S CHƯƠNG
                                            </div>
                                        </a>
                                    </li>
                                    <li class="w-20 bg-light cur-poi border-right-3 border-white ">
                                        <a href="{{URL::to('account/book/'.$truyen->id.'/chapter/create')}}" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div>
                                                <i class="nav-icon ti-plus"></i>
                                            </div>
                                            <div class="ml-1 active_none">
                                                THÊM CHƯƠNG
                                            </div>
                                        </a>
                                    </li>
                                    <li class="w-20 bg-light cur-poi border-right-3 border-white ">
                                        <a href="" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div>
                                                <i class="nav-icon ti-stats-up"></i>
                                            </div>
                                            <div class="ml-1 active_none">
                                                THỐNG KÊ
                                            </div>
                                        </a>
                                    </li>
                                    <li class="w-20 bg-light cur-poi ">
                                        <a href="" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div>
                                                <i class="nav-icon ti-receipt"></i>
                                            </div>
                                            <div class="ml-1">
                                                BÁO LỖI
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card" id="list_chapter">
                        <div class="card-body">
                            <table class="table table-responsive table-hover manage-u-table" id="tbl_account">
                                <thead>
                                    <tr>
                                        <th class="w-30 fw-500 text-center">STT</th>
                                        <th class="w-700 fw-500">Tên chương</th>
                                        <th class="w-350 fw-500">Ngày xuất bản</th>
                                        <th class="w-150 fw-500">Lượt đọc </th>
                                        <th class="w-150 fw-500">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listchapter as $key => $val)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>
                                            <a href="{{URL::to('account/book/'.$truyen->id.'/chapter/'.$val->id.'/edit')}}" class="text-primary">{{$val->tenchuong}}</a>
                                        </td>
                                        <td>{{$val->ngaydang}}</td>
                                        <td>{{$val->luotdoc}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{URL::to('account/book/'.$truyen->id.'/chapter/'.$val->id.'/edit')}}" type="button" class="btn btn-outline-warning  btn-circle btn-xs mr-2">
                                                    <i class="ti-pencil-alt"></i>
                                                </a>
                                                <form method="POST" action="{{URL::to('account/book/'.$truyen->id.'/chapter/'.$val->id.'/delete')}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger  btn-circle btn-xs" onclick=" return confirm('Bạn có chắc chắn muốn xóa chương này?')">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection