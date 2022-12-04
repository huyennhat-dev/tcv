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
                        <li class="breadcrumb-item active">Thêm Chương Mới</li>
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
                                    <li class="w-20 bg-light cur-poi border-right-3 border-white ">
                                        <a href="{{URL::to('account/book/'.$truyen->id.'/chapter/index')}}" class=" d-block py-4 fz-20 d-flex justify-content-center">
                                            <div class="pt-2px">
                                                <i class="nav-icon ti-menu-alt"></i>
                                            </div>
                                            <div class="ml-1 active_none">
                                                D.S CHƯƠNG
                                            </div>
                                        </a>
                                    </li>
                                    <li class="w-20 bg-light cur-poi border-right-3 border-white active">
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
                                            <div class="ml-1 active_none">
                                                BÁO LỖI
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{URL::to('/account/book/'.$truyen->id.'/chapter/create')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <p for="name_slug">Tên Chương </p>
                                        <input type="text" name="tenchuong"  class="form-control form-control-border" id="name_slug">
                                    </div>
                                    <input type="hidden" disabled class="form-control form-control-border" name="truyen_id" value="{{$truyen->id}}">

                                    <style>
                                        #cke_1_top {
                                            display: none !important;
                                        }

                                        #cke_1_contents {
                                            min-height: 500px !important;
                                        }
                                    </style>
                                    <div class="form-group">
                                        <p for="introduce">Nội Dung</p>
                                        <p><i class="text-secondary">Tối thiểu 1500 ký tự. </i></p>
                                        <textarea name="noidung" class="form-control form-control-border border-width-2" id="introduce"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Cập Nhật</button>
                                    </div>
                                </div>
                            </form>

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