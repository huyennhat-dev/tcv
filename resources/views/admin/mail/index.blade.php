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
                        <li class="breadcrumb-item active">Mail box</li>
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
                            <h3 class="card-title">Mail box</h3>
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
                        <div id="alert"></div>
                        <div class="card mb-0">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages py-2 px-2">
                                    <table class="table table-responsive table-hover" id="tbl_admin">
                                        <thead>
                                            <tr>
                                                <th class="w-30 fw-500 text-center">STT</th>
                                                <th class="w-150 fw-500">Hình Ảnh</th>
                                                <th class="w-150 fw-500">Người Gửi</th>
                                                <th class="w-450 fw-500">Nội Dung</th>
                                                <th class="w-150 fw-500">Thời Gian</th>
                                                <th class="w-150 fw-500">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mail as $key => $val)
                                            <tr>
                                                <td class="text-center">{{$key+1}}
                                                    @if($val->trangthai != 1 )
                                                    <a style="font-size: 10px;"><i class="fas fa-circle nav-icon text-danger"></i></a>
                                                    @endif
                                                </td>
                                                <td >
                                                     <?php $avata = "this.src='https://alfafafoods.com/wp-content/uploads/2020/10/PngJoy_gray-circle-login-user-icon-png-transparent-png_2750635-1.png'"; ?>
                                                    <img onerror="{{$avata}}" width="40" src="{{asset('public/uploads/cus_avt/'.$val->nguoigui->avatar)}}" alt="">
                                                </td>
                                                <td class="mailbox-name">
                                                    <a class="text-primary">
                                                        {{$val->nguoigui->username}}
                                                    </a>
                                                </td>
                                                <td class="mailbox-subject">
                                                    <?php $noidung = strip_tags(trim(html_entity_decode($val->noidung,   ENT_QUOTES, 'UTF-8'), "\xc2\xa0")); ?>
                                                    {{Str::limit($noidung, 65)}}
                                                </td>
                                                <td class="mailbox-date">
                                                    <?php
                                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    $date1 =  date("$val->ngaygui");
                                                    $date2 =   date("Y-m-d H:i:s");

                                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                                    $years = number_format(($diff / (365 * 60 * 60 * 24)), 1);
                                                    $months = number_format(($diff / (30 * 60 * 60 * 24)), 0);
                                                    $days = number_format(($diff / (60 * 60 * 24)), 0);
                                                    $hours = number_format(($diff  / (60 * 60)), 0);
                                                    $minutes = number_format(($diff  / 60), 0);
                                                    $seconds = number_format(($diff  / 1), 0);
                                                    if ($diff >= 31536000) {
                                                        echo  $years . ' năm trước';
                                                    }
                                                    if ($diff < 31536000 && $diff >= 2592000) {
                                                        echo  $months . ' tháng trước';
                                                    }
                                                    if ($diff < 2592000 && $diff >= 86400) {
                                                        echo  $days . ' ngày trước';
                                                    }
                                                    if ($diff < 86400 && $diff >= 3600) {
                                                        echo  $hours . ' giờ trước';
                                                    }
                                                    if ($diff < 3600 && $diff >= 60) {
                                                        echo  $minutes . ' phút trước';
                                                    }
                                                    if ($diff < 60 && $diff > 0) {
                                                        echo  $seconds . ' giây trước';
                                                    }
                                                    if ($diff === 0) {
                                                        echo  ' Vừa xong';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div >
                                                        <a href="{{URL::to('/admin/mailbox/read-mail/'.$val->id)}}" class="btn btn-primary  btn-xs mr-2">Xem</a>
                                                        <!-- <a href="" class="btn btn-danger  btn-xs ">Xóa</a> -->
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
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