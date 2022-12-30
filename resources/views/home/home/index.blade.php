@extends('../home')

@section('content')
<?php

use Illuminate\Support\Facades\Session;

$cus_name = Session::get('cus_name');
$cus_avt = Session::get('cus_avatar');
$cus_id = Session::get('cus_id');
?>
<main class="main" id="demo" style="background: url({{asset('public/uploads/slide/'.$slide->hinhanh)}}) no-repeat;">
    <div class="container row mb-20 mt-50 background-sl">
    </div>
    <input type="hidden" name="u_id" id="u_id" value="{{$cus_id}}">
    <div class="grid wide mb-20">
        <div class="container row mobile">
            <div class="col l-4 popular">
                <div class="popular-main">
                    <div class="list-popular_heading">
                        <span>Top đề cử</span>
                        <a href="{{URL::to('/xep-hang/de-cu')}}" class="link">Xem tất cả</a>
                    </div>
                    <div class="list-popular_container n-1 ">
                        <div class="row">
                            <div class="col l-1 m-1 c-1">
                                <div class="rank t-center">
                                    1
                                </div>
                            </div>
                            <div class="col l-7 m-7 c-7">
                                <a href="{{URL::to('/truyen/'.$top1_decu->slug)}}" class="book-name" style="line-height: 20px;">
                                    {{$top1_decu->tentruyen}}
                                </a>
                                <div class="voted">
                                    <span>{{$top1_decu->luotdecu}}</span>
                                    <i class="text-danger ti-gift"></i>
                                </div>
                                <div class="book-author py-10">
                                    <i class="ti-pencil-alt2"> </i>{{$top1_decu->tacgia}}
                                </div>
                                <div class="book-type">
                                    <i class="ti-wallet"> </i>{{$top1_decu->theloai->tentheloai}}
                                </div>
                            </div>
                            <div class="col l-3 m-3 c-3">
                                <div class="book-cover">
                                    <a href="{{URL::to('/truyen/'.$top1_decu->slug)}}" class="book-cover_link">
                                        <img src="{{asset('public/uploads/truyen/'.$top1_decu->hinhanh)}}" alt="{{$top1_decu->tentruyen}}">
                                    </a>
                                    <span class="book-cover-shadow"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($top10_decu as $key =>$val)
                    <div class="list-popular_container 2">
                        <div class="row py-10 ">
                            <div class="col l-1 m-1 c-1">
                                <div class="rank t-center">{{$key+2}}</div>
                            </div>
                            <div class="col l-10 m-10 c-10 d-flex jus-between">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name" style="line-height: 20px;">
                                    {{$val->tentruyen}}
                                </a>
                                <div class="voted">
                                    <span>{{$val->luotdecu}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col l-4 rewarded">
                <div class="rewarded-main">
                    <div class="list-rewarded_heading">
                        <span>Top đọc nhiều</span>
                        <a href="{{URL::to('/xep-hang/doc-nhieu')}}" class="link">Xem tất cả</a>
                    </div>
                    <div class="list-rewarded_container n-1 ">
                        <div class="row">
                            <div class="col l-1 m-1 c-1">
                                <div class="rank t-center">
                                    1
                                </div>
                            </div>
                            <div class="col l-7 m-7 c-7">
                                <a href="{{URL::to('/truyen/'.$top_1_luotxem->slug)}}" class="book-name" style="line-height: 20px;">
                                    {{$top_1_luotxem->tentruyen}}
                                </a>
                                <div class="voted">
                                    <span>{{$top_1_luotxem->luotxem}}</span>
                                    <i class="text-success ti-eye"></i>
                                </div>
                                <div class="book-author py-10">
                                    <i class="ti-pencil-alt2"> </i>{{$top_1_luotxem->tacgia}}
                                </div>
                                <div class="book-type">
                                    <i class="ti-wallet"> </i>{{$top_1_luotxem->theloai->tentheloai}}
                                </div>
                            </div>
                            <div class="col l-3 m-3 c-3">
                                <div class="book-cover">
                                    <a href="{{URL::to('/truyen/'.$top_1_luotxem->slug)}}" class="book-cover_link">
                                        <img src="{{asset('public/uploads/truyen/'.$top_1_luotxem->hinhanh)}}" title="{{$top_1_luotxem->tentruyen}}" alt="{{$top_1_luotxem->tentruyen}}">
                                    </a>
                                    <span class="book-cover-shadow"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($top10_luotxem as $key => $val)
                    <div class="list-rewarded_container 2">
                        <div class="row py-10 ">
                            <div class="col l-1 m-1 c-1" style="line-height: 20px;">
                                <div class="rank t-center">{{$key+2}}</div>
                            </div>
                            <div class="col l-10 m-10 c-10 d-flex jus-between">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name" style="line-height: 20px;">
                                    {{$val->tentruyen}}
                                </a>
                                <div class="voted">
                                    <span>{{$val->luotxem}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col l-4 nominations">
                <div class="nominations-main">
                    <div class="list-nominations_heading">
                        <span>Top thảo luận</span>
                        <a href="{{URL::to('/xep-hang/thao-luan')}}" class="link">Xem tất cả</a>
                    </div>
                    <div class="list-nominations_container n-1 ">
                        <div class="row">
                            <div class="col l-1 m-1 c-1">
                                <div class="rank t-center">
                                    1
                                </div>
                            </div>
                            <div class="col l-7 m-7 c-7">
                                <a href="{{URL::to('/truyen/'.$top1_binhluan->slug)}}" class="book-name" style="line-height: 20px;">
                                    {{$top1_binhluan->tentruyen}}
                                </a>
                                <div class="voted d-flex">
                                    <span>{{$top1_binhluan->sobinhluan}}</span>
                                    <i class="text-primary ti-comment"></i>
                                </div>
                                <div class="book-author py-10">
                                    <i class="ti-pencil-alt2"> </i>{{$top1_binhluan->tacgia}}
                                </div>
                                <div class="book-type">
                                    <i class="ti-wallet"> </i>{{$top1_binhluan->theloai->tentheloai}}
                                </div>
                            </div>
                            <div class="col l-3 m-3 c-3">
                                <div class="book-cover">
                                    <a href="{{URL::to('/truyen/'.$top1_binhluan->slug)}}" class="book-cover_link">
                                        <img src="{{asset('public/uploads/truyen/'.$top1_binhluan->hinhanh)}}" title="{{$top1_binhluan->tentruyen}}" alt="{{$top1_binhluan->tentruyen}}">
                                    </a>
                                    <span class="book-cover-shadow"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($top10_binhluan as $key => $val)
                    <div class="list-nominations_container 2">
                        <div class="row py-10 ">
                            <div class="col l-1 m-1 c-1">
                                <div class="rank t-center" style="line-height: 20px;">{{$key+2}}</div>
                            </div>
                            <div class="col l-10 m-10 c-10 d-flex jus-between">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name " style="line-height: 20px;">
                                    {{$val->tentruyen}}
                                </a>
                                <div class="voted">
                                    <span>{{$val->sobinhluan}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Rank moblie -->
            <div class="col l-12 rank-mobile ">
                <div class="rank_heading py-10">Bảng xếp hạng </div>
                <div class="row tabs ">
                    <div class="col l-4 tab-item active">
                        Đề cử
                    </div>
                    <div class="col l-4 tab-item">
                        Đọc nhiều
                    </div>
                    <div class="col l-4 tab-item">
                        Bình luận
                    </div>
                    <div class="line"></div>
                </div>

                <!-- tab content -->
                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="list-popular_container n-1 ">
                            <div class="row">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">
                                        1
                                    </div>
                                </div>
                                <div class="col l-7 m-7 c-7">
                                    <a href="{{URL::to('/truyen/'.$top1_decu->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$top1_decu->tentruyen}}
                                    </a>
                                    <div class="voted">
                                        <span>{{$top1_decu->luotdecu}}</span>
                                        <i class="text-danger ti-gift"></i>
                                    </div>
                                    <div class="book-author py-10">
                                        <i class="ti-pencil-alt2"> </i>{{$top1_decu->tacgia}}
                                    </div>
                                    <div class="book-type">
                                        <i class="ti-wallet"> </i>{{$top1_decu->theloai->tentheloai}}
                                    </div>
                                </div>
                                <div class="col l-3 m-3 c-3">
                                    <div class="book-cover">
                                        <a href="{{URL::to('/truyen/'.$top1_decu->slug)}}" class="book-cover_link">
                                            <img src="{{asset('public/uploads/truyen/'.$top1_decu->hinhanh)}}" alt="{{$top1_decu->tentruyen}}" title="{{$top1_decu->tentruyen}}">
                                        </a>
                                        <span class="book-cover-shadow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($top10_decu as $key => $val)
                        <div class="list-popular_container 2">
                            <div class="row py-10 ">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">{{$key+2}}</div>
                                </div>
                                <div class="col l-10 m-10 c-10 d-flex jus-between">
                                    <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$val->tentruyen}}
                                    </a>
                                    <div class="voted">
                                        <span>{{$val->luotdecu}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="list-popular_container 2">
                            <div class="row py-10 mt-2 ml-2">
                                <a href="{{URL::to('/xep-hang/de-cu')}}" style="color: #b78a28;">Xem tất cả <i class="ti-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane">
                        <div class="list-popular_container n-1 ">
                            <div class="row">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">
                                        1
                                    </div>
                                </div>
                                <div class="col l-7 m-7 c-7">
                                    <a href="{{URL::to('/truyen/'.$top_1_luotxem->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$top_1_luotxem->tentruyen}}

                                    </a>
                                    <div class="voted">
                                        <span>{{$top_1_luotxem->luotxem}}</span>
                                        <i class="text-success ti-eye"></i>
                                    </div>
                                    <div class="book-author py-10">
                                        <i class="ti-pencil-alt2"> </i>{{$top_1_luotxem->tacgia}}
                                    </div>
                                    <div class="book-type">
                                        <i class="ti-wallet"> </i>{{$top_1_luotxem->theloai->tentheloai}}
                                    </div>
                                </div>
                                <div class="col l-3 m-3 c-3">
                                    <div class="book-cover">
                                        <a href="{{URL::to('/truyen/'.$top_1_luotxem->slug)}}" class="book-cover_link">
                                            <img src="{{asset('public/uploads/truyen/'.$top_1_luotxem->hinhanh)}}" alt="{{$top_1_luotxem->tentruyen}}" title="{{$top_1_luotxem->tentruyen}}">
                                        </a>
                                        <span class="book-cover-shadow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($top10_luotxem as $key => $val)
                        <div class="list-popular_container 2">
                            <div class="row py-10 ">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">{{$key+2}}</div>
                                </div>
                                <div class="col l-10 m-10 c-10 d-flex jus-between">
                                    <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$val->tentruyen}}
                                    </a>
                                    <div class="voted">
                                        <span>{{$val->luotxem}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="list-popular_container 2">
                            <div class="row py-10 mt-2 ml-2">
                                <a href="{{URL::to('/xep-hang/doc-nhieu')}}" style="color: #b78a28;">Xem tất cả <i class="ti-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane">
                        <div class="list-popular_container n-1 ">
                            <div class="row">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">
                                        1
                                    </div>
                                </div>
                                <div class="col l-7 m-7 c-7">
                                    <a href="{{URL::to('/truyen/'.$top1_binhluan->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$top1_binhluan->tentruyen}}

                                    </a>
                                    <div class="voted">
                                        <span>{{$top1_binhluan->sobinhluan}}</span>
                                        <i class="text-primary ti-comment"></i>
                                    </div>
                                    <div class="book-author py-10">
                                        <i class="ti-pencil-alt2"> </i>{{$top1_binhluan->tacgia}}
                                    </div>
                                    <div class="book-type">
                                        <i class="ti-wallet"> </i>{{$top1_binhluan->theloai->tentheloai}}
                                    </div>
                                </div>
                                <div class="col l-3 m-3 c-3">
                                    <div class="book-cover">
                                        <a href="{{URL::to('/truyen/'.$top1_binhluan->slug)}}" class="book-cover_link">
                                            <img src="{{asset('public/uploads/truyen/'.$top1_binhluan->hinhanh)}}" alt="{{$top1_binhluan->tentruyen}}" title="{{$top1_binhluan->tentruyen}}">
                                        </a>
                                        <span class="book-cover-shadow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($top10_binhluan as $key => $val)
                        <div class="list-popular_container 2">
                            <div class="row py-10 ">
                                <div class="col l-1 m-1 c-1">
                                    <div class="rank t-center">{{$key+2}}</div>
                                </div>
                                <div class="col l-10 m-10 c-10 d-flex jus-between">
                                    <a href="{{URL::to('/truyen/'.$val->slug)}}" class="book-name" style="line-height: 20px;">
                                        {{$val->tentruyen}}
                                    </a>
                                    <div class="voted">
                                        <span>{{$val->sobinhluan}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="list-popular_container 2">
                            <div class="row py-10 mt-2 ml-2">
                                <a href="{{URL::to('/xep-hang/thao-luan')}}" style="color: #b78a28;">Xem tất cả <i class="ti-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid wide mb-20">
        <div class="container ">
            <div class="row">
                <div class="col l-8 m-12">
                    <div class="row">
                        <div class="appreciate w-100">
                            <div class="heading">
                                <div class="title">Có thể bạn sẽ muốn</div>
                                <a href="" class="link pr-20">Xem tất cả</a>
                            </div>
                        </div>
                        @foreach($rand_btvdecu as $key => $val)
                        <div class="col l-6 m-6 c-12  border-bottom pb-15 pt-15 pl-15 pr-15">
                            <div class="media">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--72 shadow mr-3">
                                    <img src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}" width="72">
                                </a>
                                <div class="media-body">
                                    <h2 class="fz-13 fw-500 text-overflow-1-lines mb-8">
                                        <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-block">{{$val->tentruyen}}</a>
                                    </h2>
                                    <div class="d-flex align-items-center mb-8">
                                        <div class="text-success fz-13"> {{$count_chap[$key]}} chương </div>
                                    </div>
                                    <div class="text-secondary fz-13 mb-8 text-overflow-2-lines lh-15"><?= $val->mota ?> </div>
                                    <div class="d-flex align-items-center mt-2 py-1 jus-between">
                                        <div class="d-flex align-items-center mr-auto text-secondary">
                                            <span class="truncate-140 text-left fz-12 fw-500 lh-14">
                                                <i class="nh-icon ti-pencil-alt2 mr-1"></i>
                                                {{$val->tacgia}}
                                            </span>
                                        </div>
                                        <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}">
                                            <span class="d-inline-block border fz-12 border-primary small px-2 py-8 text-primary truncate-150">
                                                {{$val->theloai->tentheloai}}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col l-4 m-12">
                    <div class="appreciate w-100">
                        <div class="heading">
                            <div class="title">Đang đọc</div>
                            <a href="{{route('library')}}" class="link pr-20">Xem tất cả</a>
                        </div>
                    </div>
                    <ul class="list-unstyled ">
                        @csrf
                        <div>
                            @if($cus_id)
                            <div id="reading_show"></div>

                            <script>
                                $(document).ready(function() {
                                    var _token = $('input[name="_token"]').val()
                                    load_reading()

                                    function load_reading() {
                                        $.ajax({
                                            url: "{{url('/load_reading')}}",
                                            method: "POST",
                                            data: {
                                                _token: _token
                                            },
                                            success: function(data) {
                                                $('#reading_show').html(data)
                                            }
                                        })
                                    }
                                    $(document).on('click', '.del_reading_btn', function(e) {
                                        e.preventDefault()
                                        var id = $(this).data('idx')
                                        if (confirm('Bạn muốn xóa truyện này?')) {
                                            $.ajax({
                                                url: "{{url('/del_reading')}}",
                                                method: "POST",
                                                data: {
                                                    id: id,
                                                    _token: _token
                                                },
                                                success: function(data) {
                                                    load_reading()
                                                }
                                            })
                                        }

                                    })
                                })
                            </script>
                            @else
                            @foreach($dangdoc_2 as $key =>$val)
                            <li class="media align-items-center py-2 mb-1 pl-2 pr-2">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--32 shadow mr-3" style="width: 40px;">
                                    <img alt="{{$val->tentruyen}}" width="40 " src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}">
                                </a>
                                <div class="media-body">
                                    <h2 class="fz-body mb-1"><a href="{{URL::to('/truyen/'.$val->slug)}}" class="text-overflow-1-lines">
                                            {{$val->tentruyen}}
                                        </a></h2>
                                    <div class="text-muted text-overflow-1-lines text-secondary fz-12">
                                        Đã đọc: 0/{{$count_chap_y[$key]}}
                                    </div>
                                </div>
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="float-left fz-12"><small class="text-primary">Đọc truyện</small></a>
                            </li>
                            @endforeach
                            @endif
                        </div>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="grid wide mb-20">
        <div class="container row">
            <div class="news-update w-100">
                <div class="heading">
                    <div class="title">Mới cập nhật</div>
                    <a href="" class="link pr-20">Xem tất cả</a>
                </div>
                <div class="body pl-15 pr-15">
                    <table class="tbl_news-update table-striped table-hover table border-top fz-13 fw-500 ">
                        <tbody>
                            @foreach($chap_moi as $key => $val)
                            <tr>
                                <td class="align-middle text-tertiary"><span class="text-overflow-1-lines">{{$val->truyen->theloai->tentheloai}}</span></td>
                                <td class="align-middle w-25">
                                    <h2 class="fz-body m-0 text-overflow-1-lines">
                                        <a class="fw-600" href="{{URL::to('/truyen/'.$val->truyen->slug)}}" style="font-size: 13px !important;">{{$val->truyen->tentruyen}}</a>
                                    </h2>
                                </td>
                                <td class="align-middle w-25">
                                    <a href="{{URL::to('/truyen/'.$val->truyen->slug.'/chuong-'.$val->slug)}}" class="text-overflow-1-lines" style="font-size: 13px !important;">
                                        <span>Chương {{$val->slug}}:</span> {{$val->tenchuong}}
                                    </a>
                                </td>
                                <td class="align-middle"><span class="text-overflow-1-lines">{{$val->truyen->tacgia}}</span></td>
                                <td class="align-middle text-tertiary"><span class="text-overflow-1-lines">{{$val->truyen->nguoidang->username}}</span></td>
                                <td class="align-middle text-tertiary text-right">
                                    <?php
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $date1 =  date("$val->ngaydang");
                                    $date2 =   date("Y-m-d H:i:s");
                                    // echo $date1.'<br>';
                                    // echo $date2;
                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                    $years = number_format(($diff / (365 * 60 * 60 * 24)), 1);
                                    $months = number_format(($diff / (30 * 60 * 60 * 24)), 0);
                                    $days = number_format(($diff / (60 * 60 * 24)), 0);
                                    $hours = number_format(($diff  / (60 * 60)), 0);
                                    $minutes = number_format(($diff  / 60), 0);
                                    $seconds = number_format(($diff  / 1), 0);
                                    if ($diff >= 31536000) {
                                        echo $years . ' năm trước';
                                    }
                                    if ($diff < 31536000 && $diff >= 2592000) {
                                        echo $months . ' tháng trước';
                                    }
                                    if ($diff < 2592000 && $diff >= 86400) {
                                        echo $days . ' ngày trước';
                                    }
                                    if ($diff < 86400 && $diff >= 3600) {
                                        echo $hours . ' giờ trước';
                                    }
                                    if ($diff < 3600 && $diff >= 60) {
                                        echo $minutes . ' phút trước';
                                    }
                                    if ($diff < 60 && $diff > 0) {
                                        echo $seconds . ' giây trước';
                                    }
                                    if ($diff === 0) {
                                        echo ' Vừa xong';
                                    }
                                    ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="nh-section__body pl-15 pr-15">
                    <ul class="list-unstyled list-stripped">
                        @foreach($chap_moi as $key => $val)
                        <li>
                            <div class="media py-2">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="fz-13 fw-500 mb-8 lh-15x" style="flex: 1;">
                                            <a href="{{URL::to('/truyen/'.$val->truyen->slug)}}">{{$val->truyen->tentruyen}} </a>
                                        </h2>
                                        <a href="{{URL::to('/truyen/'.$val->truyen->slug.'/chuong-'.$val->slug)}}" class="font-weight-semibold ml-2 text-primary" style="width: 50px;">C.{{$val->slug}}</a>
                                    </div>
                                    <div class="d-flex align-items-center  py-1 ">
                                        <div class=" text-left fz-12 fw-500 text-secondary"><i class="nh-icon ti-ink-pen mr-2"></i> {{$val->truyen->tacgia}} </div>
                                        <div class="d-inline-block  fz-12  px-2 py-8 text-secondary"><i class="nh-icon ti-wallet mr-2"></i> {{$val->truyen->theloai->tentheloai}} </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="grid wide mb-20">
        <div class="container ">
            <div class="row">
                <div class="col l-4 m-12 c-12">
                    <div class="appreciate w-100">
                        <div class="heading">
                            <div class="title">Mới đánh giá</div>
                            <a href="" class="link pr-20">Xem tất cả</a>
                        </div>
                    </div>
                    <ul class="list-unstyled ">
                        <div>
                            @foreach($vote as $key => $val)
                            <li class=" align-items-center py-3 mb-2 pl-3 px-2" style="background-color: #f7f5f0!important;">
                                <div class="media">
                                    <?php
                                    $avata = "this.src='https://static.cdnno.com/user/default/100.jpg'";
                                    ?>
                                    <img onerror="{{$avata}}" alt="{{$val->tentruyen}}" width="40" class="br-50 mr-2" src="{{asset('public/uploads/cus_avt/'.$val->account->avatar)}}">
                                    <div class="media-body">
                                        <h2 class="fz-body mb-0"><a href="" class="text-overflow-1-lines">
                                                {{$val->account->username}} <span class="text-secondary fz-12">đánh giá</span>
                                            </a>
                                        </h2>
                                        <div class="d-flex text-muted text-overflow-1-lines text-secondary fz-15">
                                            <a href="{{URL::to('/truyen/'.$val->truyen->slug)}}" class=" text-danger text-overflow-1-lines text-secondary fz-15">
                                                {{$val->truyen->tentruyen}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <span class="d-flex align-items-center text-tertiary fz-15">
                                        <ul class="list-inline d-flex position-relative rating mb-0 mt-1">
                                            <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                            <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                            <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                            <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                            <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                            <ul class="d-flex active" style="width: <?php $val->sosao*100/5?>%">
                                                <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                            </ul>
                                        </ul>
                                        <span class="mt-1 ml-2">{{floor($val->sosao)}}/5</span>
                                    </span>
                                </div>
                                <div class="text-secondary fz-13 mt-3 text-overflow-2-lines lh-15">
                                    {{$val->noidung}}
                                </div>
                            </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
                <div class="col l-8 m-12 c-12">
                    <div class="row">
                        <div class="appreciate w-100">
                            <div class="heading">
                                <div class="title">Đánh giá cao</div>
                                <a href="" class="link pr-20">Xem tất cả</a>
                            </div>
                        </div>
                        @foreach($topdanhgia as $key => $val)
                        <div class="col l-6 m-6 c-12  border-bottom pb-15 pt-15 pl-15 pr-15">
                            <div class="media">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--72 shadow mr-3">
                                    <img src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}" width="72">
                                </a>
                                <div class="media-body">
                                    <h2 class="fz-13 fw-500 text-overflow-1-lines mb-8">
                                        <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-block">{{$val->tentruyen}}</a>
                                    </h2>
                                    <div class="d-flex align-items-center mb-8">
                                        <span class="d-flex align-items-center text-tertiary fz-15">
                                            <ul class="list-inline d-flex position-relative rating mb-0">
                                                <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                <ul class="d-flex active" style="width:<?php $val->sosao*100/5?> %">
                                                    <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                </ul>
                                            </ul>
                                            <div class="text-success fz-13 ml-2"> {{floor($val->sosao)}}/5 ({{$val->sodanhgia}} đánh giá) </div>
                                        </span>
                                    </div>
                                    <div class="text-secondary fz-13 mb-8 text-overflow-2-lines lh-15"><?= $val->mota ?> </div>
                                    <div class="d-flex align-items-center mt-2 py-1 jus-between">
                                        <div class="d-flex align-items-center mr-auto text-secondary">
                                            <span class="truncate-140 text-left fz-12 fw-500 lh-14">
                                                <i class="nh-icon ti-pencil-alt2 mr-1"></i>
                                                {{$val->tacgia}}
                                            </span>
                                        </div>
                                        <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}">
                                            <span class="d-inline-block border fz-12 border-primary small px-2 py-8 text-primary truncate-150">
                                                {{$val->theloai->tentheloai}}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="grid wide mb-20">
        <div class="container ">
            <div class="row">
                <div class="appreciate w-100">
                    <div class="heading">
                        <div class="title">Hoàn thành</div>
                        <a href="" class="link pr-20">Xem tất cả</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($truyenhoanthanh as $key => $val)
                <div class="col l-4 m-6 c-12  border-bottom pb-15 pt-15 pl-15 pr-15">
                    <div class="media">
                        <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--72 shadow mr-3">
                            <img src="{{('public/uploads/truyen/'.$val->hinhanh)}}" alt="{{$val->tentruyen}}" title="{{$val->tentruyen}}" width="72">
                        </a>
                        <div class="media-body">
                            <h2 class="fz-13 fw-500 text-overflow-1-lines mb-8">
                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-block">
                                    {{$val->tentruyen}}
                                </a>
                            </h2>
                            <div class="d-flex align-items-center mb-8">
                                <div class="text-success fz-13"> {{$count_chap_x[$key]}} chương </div>
                            </div>
                            <div class="text-secondary fz-13 mb-8 text-overflow-2-lines lh-15">
                                <?= $val->mota ?>
                            </div>
                            <div class="d-flex align-items-center mt-2 py-1 jus-between">
                                <div class="d-flex align-items-center mr-auto text-secondary">
                                    <span class="truncate-140 text-left fz-12 fw-500 lh-14">
                                        <i class="nh-icon ti-pencil-alt2 mr-1"></i>
                                        {{$val->tacgia}}

                                    </span>
                                </div>
                                <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}">
                                    <span class="d-inline-block border fz-12 border-primary small px-2 py-8 text-primary truncate-150">
                                        {{$val->theloai->tentheloai}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

@endsection