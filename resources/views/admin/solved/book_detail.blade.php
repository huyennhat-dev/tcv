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
                        <li class="breadcrumb-item"><a href="{{route('solved')}}">Truyện đã phê duyệt</a></li>
                        <li class="breadcrumb-item active">{{$truyen->tentruyen}}</li>
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
                            <h3 class="card-title">{{$truyen->tentruyen}}</h3>
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
                        <div class="card mb-0" id="">
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="px-2">
                                                            <div>Ảnh Bìa </div>
                                                            <div>
                                                                <img width="120" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <p for="name_slug">Tên Truyện </p>
                                                        <input type="text" name="tentruyen" value="{{$truyen->tentruyen}}" disabled onkeyup="ChangeToSlug()" class="form-control form-control-border" id="name_slug">
                                                    </div>
                                                    <input type="hidden" disabled class="form-control form-control-border" name="slug" value="{{$truyen->slug}} id=" convert_slug">
                                                    <div class="form-group">
                                                        <p for="classify">Phân Loại</p>
                                                        <select name="phanloai" class="custom-select form-control-border" disabled id="classify">
                                                            @if($truyen->phanloai == 0)
                                                            <option selected value="0">Truyện Nam</option>
                                                            @else
                                                            <option selected value="1">Truyện Nữ</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="">Tình Trạng</p>
                                                        <select name="tinhtrang" class="custom-select form-control-border">
                                                            @if($truyen->tinhtrang == 0)
                                                            <option selected value="0">Đang ra</option>
                                                            <option value="1">Hoàn thanh</option>
                                                            <option value="2">Dừng viết</option>
                                                            @elseif($truyen->tinhtrang == 1)
                                                            <option value="0">Đang ra</option>
                                                            <option selected value="1">Hoàn thanh</option>
                                                            <option value="2">Dừng viết</option>
                                                            @else
                                                            <option value="0">Đang ra</option>
                                                            <option value="1">Hoàn thanh</option>
                                                            <option selected value="2">Dừng viết</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="category">Thể loại</p>
                                                        <select name="theloai" class="custom-select form-control-border" id="category">
                                                            @foreach($theloai as $val)
                                                            <option <?php
                                                                    if ($truyen->theloai_id === $val->id) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="{{$val->id}}">{{$val->tentheloai}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <style>
                                                        #cke_1_top {
                                                            display: none !important;
                                                        }
                                                    </style>
                                                    <div class="form-group">
                                                        <p for="introduce">Giới Thiệu</p>
                                                        <p><?= $truyen->mota ?></p>
                                                    </div>
                                                    <hr>
                                                   
                                                    <div class="form-group">
                                                        <p for="rewarded">Tính Cách Nhân Vật Chính</p>
                                                        <select name="tinhcach" class="custom-select form-control-border" id="rewarded">
                                                            @foreach($tinhcach as $val)
                                                            <option <?php
                                                                    if ($truyen->tinhcach_id == $val->id) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="{{$val->id}}">{{$val->tentinhcach}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="world">Bối Cảnh Thế Giới</p>
                                                        <select name="thegioi" class="custom-select form-control-border" id="world">
                                                            @foreach($thegioi as $val)
                                                            <option <?php
                                                                    if ($truyen->thegioi_id == $val->id) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="{{$val->id}}">{{$val->tenthegioi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="sect">Lưu Phái</p>
                                                        <select name="luuphai" class="custom-select form-control-border" id="sect">
                                                            @foreach($luuphai as $val)
                                                            <option <?php
                                                                    if ($truyen->luuphai_id == $val->id) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="{{$val->id}}">{{$val->tenluuphai}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
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