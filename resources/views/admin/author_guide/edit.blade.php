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
                        <li class="breadcrumb-item"><a href="{{route('author-guide.index')}}">Danh sách hướng dẫn tác giả</a></li>
                        <li class="breadcrumb-item active">Sửa hướng dẫn tác giả</li>
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
                            <h3 class="card-title">Sửa hướng dẫn tác giả</h3>
                        </div>
                        <!--  -->
                        @if ($errors->any())
                        <div class=" alert-form">
                            <div id="toast-container" class="toast-top-right">
                                <div class="alert toast toast-error" aria-live="assertive">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="toast-message">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @endif
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
                        @if (session('error'))
                        <div class=" alert-form">
                            <div id="toast-container" class="toast-top-right">
                                <div class="alert toast toast-warning" aria-live="assertive">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="toast-message">{{ session('error') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{route('author-guide.update', [$authorGuide->id])}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="ques" class="font-weight-normal">Câu hỏi</label>
                                    <input autocomplete="off" class="form-control" id="ques" type="text" name="cauhoi" value="{{$authorGuide->cauhoi}}">
                                </div>
                                <style>
                                    #cke_1_top {
                                        display: none !important;
                                    }
                                </style>
                                <div class="form-group">
                                    <label for="cautraloi" class="font-weight-normal">Câu trả lời</label>
                                    <textarea id="cautraloi" name="cautraloi">{{$authorGuide->cautraloi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="trangthai" class="font-weight-normal">Trạng thái</label>
                                    <select class="custom-select" id="trangthai" name="trangthai">
                                        @if($authorGuide->trangthai === 0)
                                        <option selected value="0">Hiện</option>
                                        <option value="1">Ẩn</option>
                                        @else
                                        <option value="0">Hiện</option>
                                        <option selected value="1">Ẩn</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary toastrDefaultSuccess">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
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