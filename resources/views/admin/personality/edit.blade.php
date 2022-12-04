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
                        <li class="breadcrumb-item"><a href="{{route('personality.index')}}">Danh sách tính cách nhân vật</a></li>
                        <li class="breadcrumb-item active">Sửa tính cách nhân vật</li>
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
                            <h3 class="card-title">Sửa tính cách nhân vật</h3>
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
                            <form method="POST" action="{{route('personality.update', [$personality->id])}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name_slug" class="font-weight-normal">Tên tính cách nhân vật</label>
                                    <input readonly autocomplete="off" class="form-control" onkeyup="ChangeToSlug()" id="name_slug" type="text" name="tentinhcach" value="{{$personality->tentinhcach}}">
                                </div>
                                <input readonly autocomplete="off" class="form-control" id="convert_slug" type="hidden" name="slug" value="{{$personality->slug}}">
                                <div class="form-group">
                                    <label for="trangthai" class="font-weight-normal">Trạng thái</label>
                                    <select class="custom-select" id="trangthai" name="trangthai">
                                        @if($personality->trangthai === 0)
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