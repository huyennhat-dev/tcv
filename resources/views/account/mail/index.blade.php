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
                        <li class="breadcrumb-item active">Cài Đặt</li>
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
                    <div class="card card-tabs">
                        <div class="card-header pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-black" data-toggle="pill" href="#tab_1" role="tab" aria-selected="true">Thư Đến</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" data-toggle="pill" href="#tab_2" role="tab" aria-selected="false">Soạn Thư</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                                    <div class="table-responsive mailbox-messages py-2 px-2">
                                        <table class="table table-hover table-striped" id="tbl_account">
                                            <thead>
                                                <tr>
                                                    <th width="30" class="text-center">STT</th>
                                                    <th>Người Gửi</th>
                                                    <th width="500">Nội Dung</th>
                                                    <th>Thời Gian</th>
                                                    <th>Thao Tác</th>
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
                                                    <td class="mailbox-name">
                                                        <a class="text-primary">
                                                            @if($val->send_id === 0)
                                                            Admin Truyện Convert
                                                            @else
                                                            @endif
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
                                                        <div class=" text-center">
                                                            <a href="{{URL::to('/account/mail/read-mail/'.$val->id)}}" class="btn btn-primary  btn-xs mr-2">Xem</a>
                                                            <!-- <a href="" class="btn btn-danger  btn-xs ">Xóa</a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_2" role="tabpanel">
                                    <div class="table-responsive mailbox-messages py-2 px-2 jus">
                                        <table class="table manage-u-table mr-auto ml-auto" style="max-width: 800px;">
                                            <thead>
                                                <tr>
                                                    <th width="30" class="text-center">STT</th>
                                                    <th>Hình Ảnh</th>
                                                    <th>Tên </th>
                                                    <th width="150">Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><a href=""><img width="50" src="{{asset('public/uploads/logo/logo.png')}}" alt=""></a></td>
                                                    <td><a href="" class="text-primary">Admin Truyện Conver</a></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{URL::to('/account/mail/0')}}" class="btn btn-primary btn-xs ">Nhắn Tin</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
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