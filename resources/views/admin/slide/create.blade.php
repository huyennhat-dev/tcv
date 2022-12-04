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
                        <li class="breadcrumb-item active">Thêm slide</li>
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
                            <h3 class="card-title">Thêm slide</h3>
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
                            <form method="POST" action="{{route('slide.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="avatar-preview container2">
                                        @php
                                        if(!empty($image->image) && $image->image!='' && file_exists(public_path('images/'.$image->image))){
                                        $image =$image->image;
                                        }else{
                                        $image = 'slide/truyen.jpg';
                                        }
                                        $url = url('public/uploads/'.$image);
                                        $imgs = "background:url($url) no-repeat";
                                        @endphp
                                        <div id="imagePreview" class="mb-2" style="<?= $imgs ?>">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input style="margin-top: 60px;" type="button" class="d-none">
                                        </div>
                                    </div>
                                    <label for="imageUpload" class="font-weight-normal">Hình ảnh slide</label>
                                    <input class="form-control-file imageUpload" id="imageUpload" type="file" name="hinhanh">
                                    <input type="hidden" name="base64image" name="base64image" id="base64image">
                                </div>
                                <div class="form-group">
                                    <label for="mota" class="font-weight-normal">Mô tả slide</label>
                                    <input autocomplete="off" class="form-control" id="mota" type="text" name="mota" value="{{old('mota')}}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary toastrDefaultSuccess">Thêm</button>
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