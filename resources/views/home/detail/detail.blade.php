@extends('../home')

@section('content')
<?php

use Illuminate\Support\Facades\Session;
// echo url()->previous();
?>
<main class="main" id="demo" style="background: url({{asset('public/uploads/slide/'.$slide->hinhanh)}}) no-repeat;">
    <div class="container row mb-20 mt-50 background-sl">
    </div>
    @csrf
    <?php
    $cus_name = Session::get('cus_name');
    $cus_avt = Session::get('cus_avatar');
    $cus_id = Session::get('cus_id');
    ?>
    <input type="hidden" name="truyen_id" id="truyen_id" value="{{$truyen->id}}">
    <input type="hidden" name="u_id" id="u_id" value="{{$cus_id}}">
    <input type="hidden" name="u_name" id="u_name" value="{{$cus_name}}">
    <input type="hidden" name="u_img" id="u_img" value="{{$cus_avt}}">
    <div id="notify">

    </div>

    <div class="grid wide  br-5 chitiettruyen">
        <div class="container row detail pb-25">
            <div class="col l-12 m-12 c-12">
                <div class="detail_nav bg-while media row pt-50 ">
                    <div class=" col l-3 m-12 c-12 text-center">
                        <div class="nh-thumb nh-thumb--210 shadow">
                            <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" title="{{$truyen->tentruyen}}" alt="{{$truyen->tentruyen}}">
                        </div>
                    </div>
                    <div class="col l-9 m-12 c-12 media-body">
                        <div class="d-flex justify-content-start mb-3">
                            <h1 class="fw-600 fz-24 mr-4 lh-14x">
                                <a class="book-name" href="{{URL::to('/truyen/'.$truyen->slug)}}">{{$truyen->tentruyen}}</a>
                            </h1>
                        </div>
                        <ul class="list-unstyled mb-4">
                            <li class="d-inline-block border fz-15 fw-400 border-secondary pl-15 pr-15 pb-2 pt-2 text-secondary rounded-3 mr-2 mb-2">
                                <a href="{{URL::to('/tim-kiem?tukhoa='.$truyen->tacgia)}}"> {{$truyen->tacgia}}</a>
                            </li>
                            <li class="d-inline-block border fz-15 fw-400 border-danger pl-15 pr-15 pb-2 pt-2 text-danger rounded-3 mr-2 mb-2">
                                @if($truyen->tinhtrang === 0)
                                <a class="text-danger" href="{{URL::to('/trang-thai/0')}}">Đang Ra</a>
                                @else
                                <a class="text-danger" href="{{URL::to('/trang-thai/1')}}">Hoàn Thành</a>
                                @endif
                            </li>
                            <li class="d-inline-block border fz-15 fw-400 border-primary pl-15 pr-15 pb-2 pt-2 text-primary rounded-3 mr-2 mb-2">
                                <a href="{{URL::to('/the-loai/'.$truyen->theloai->slug)}}" class="text-primary">
                                    {{$truyen->theloai->tentheloai}}
                                </a>
                            </li>
                            <li class="d-inline-block border fz-15 fw-400 border-success pl-15 pr-15 pb-2 pt-2 text-success rounded-3 mr-2 mb-2">
                                <a href="{{URL::to('/tinh-cach/'.$truyen->tinhcach->slug)}}" class="text-success">
                                    {{$truyen->tinhcach->tentinhcach}}
                                </a>
                            </li>
                            <li class="d-inline-block border fz-15 fw-400 border-success pl-15 pr-15 pb-2 pt-2 text-success rounded-3 mr-2 mb-2">
                                <a href="{{URL::to('/boi-canh-the-gioi/'.$truyen->thegioi->slug)}}" class="text-success">
                                    {{$truyen->thegioi->tenthegioi}}
                                </a>
                            </li>
                            <li class="d-inline-block border fz-15 fw-400 border-success pl-15 pr-15 pb-2 pt-2 text-success rounded-3 mr-2 mb-2">
                                <a href="{{URL::to('/luu-phai/'.$truyen->luuphai->slug)}}" class="text-success">
                                    {{$truyen->luuphai->tenluuphai}}
                                </a>
                            </li>
                        </ul>
                        <ul class="list-unstyled d-flex mb-4">
                            <li class="mr-5">
                                <div class="text-center fw-500 fz-20 mb-1">{{$count_chap}}</div>
                                <div class="text-center fz-15 fw-500">Chương</div>
                            </li>
                            <li class="mr-5">
                                <div class="text-center fw-500 fz-20 mb-1">{{$truyen->luotxem}}</div>
                                <div class="text-center fz-15 fw-500">Lượt đọc</div>
                            </li>
                            <li class="mr-5">
                                <div class="text-center fw-500 fz-20 mb-1">{{$truyen->luotdecu}}</div>
                                <div class="text-center fz-15 fw-500">Đề cử</div>
                            </li>
                            <li class="mr-5">
                                <div id="bookmarkedValue" class="text-center fz-20 mb-1">{{$socatgiu}}</div>
                                <div class="text-center fz-15 fw-500">Cất giữ</div>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center mb-4" id="rating_show">

                        </div>
                        <ul class="row list-unstyled d-flex align-items-center pr-30">
                            <li id="reading-book" class="col l-4 m-12 c-12 ">
                                @if($doctiep)
                                <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$doctiep->chuong_slug)}}" class="fz-14 fw-600 border border-danger text-danger btn-md btn-block btn-shadow fw-600 d-flex align-items-center justify-content-center">
                                    <i class="nh-icon ti-eye"> </i> &nbsp;Đọc tiếp
                                </a>
                                @else
                                <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$chuongdau->slug)}}" class="fz-14 fw-600 border border-danger text-danger btn-md btn-block btn-shadow fw-600 d-flex align-items-center justify-content-center">
                                    <i class="nh-icon ti-eye"> </i> &nbsp;Đọc truyện
                                </a>
                                @endif
                            </li>
                            <li id="bookmark" class="col l-4 m-6 c-6 ">
                                <span id="tickbook_show">
                                </span>
                            </li>

                            <li id="suggest-book" class="col l-4 m-6 c-6 ">
                                <div>
                                    <!---->
                                    <a href="javascript:void(0);" id="nominate_btn" class="border fz-14 btn-outline-warning btn-md btn-block bg-yellow-white text-primary fw-600 d-flex align-items-center justify-content-center">
                                        <!----><i class="ti-gift"></i> &nbsp;Đề cử
                                    </a>
                                    <!---->
                                </div>
                            </li>
                            <script>
                                $(document).ready(function() {
                                    var _token = $('input[name="_token"]').val()
                                    var u_id = $('#u_id').val()
                                    var truyen_id = $('#truyen_id').val()
                                    load_tickbook()

                                    function load_tickbook() {
                                        // alert(truyen_id)
                                        $.ajax({
                                            url: "{{url('/load_tickbook')}}",
                                            method: "POST",
                                            data: {
                                                truyen_id: truyen_id,
                                                u_id: u_id,
                                                _token: _token
                                            },
                                            success: function(data) {
                                                $('#tickbook_show').html(data)
                                            }
                                        })
                                    }

                                    $(document).on('click', '#tickbook_btn', function(e) {
                                        e.preventDefault()
                                        <?php
                                        if (isset($cus_id)) {
                                        ?>
                                            $.ajax({
                                                url: "{{url('/tickbook')}}",
                                                method: "POST",
                                                data: {
                                                    truyen_id: truyen_id,
                                                    u_id: u_id,
                                                    _token: _token
                                                },
                                                success: function(data) {
                                                    load_tickbook()
                                                    $('#notify').html(data)
                                                    $('.alert-form').fadeOut(5000)
                                                }
                                            })
                                        <?php } else { ?>
                                            window.location = "{{URL::to('account/login')}}"
                                        <?php } ?>

                                    })
                                    $(document).on('click', '#del_tickbook_btn', function(e) {
                                        e.preventDefault()
                                        <?php
                                        if (isset($cus_id)) {
                                        ?>
                                            $.ajax({
                                                url: "{{url('/del_tickbook')}}",
                                                method: "POST",
                                                data: {
                                                    truyen_id: truyen_id,
                                                    u_id: u_id,
                                                    _token: _token
                                                },
                                                success: function(data) {
                                                    load_tickbook()
                                                    $('#notify').html(data)
                                                    $('.alert-form').fadeOut(5000)
                                                }
                                            })
                                        <?php } else { ?>
                                            window.location = "{{URL::to('account/login')}}"
                                        <?php } ?>
                                    })
                                    $('#nominate_btn').click(function(e) {
                                        e.preventDefault()
                                        <?php
                                        if (isset($cus_id)) {
                                        ?>
                                            $.ajax({
                                                url: "{{url('/nominate_send')}}",
                                                method: "POST",
                                                data: {
                                                    truyen_id: truyen_id,
                                                    _token: _token
                                                },
                                                success: function(data) {
                                                    $('#notify').html(data)
                                                    $('.alert-form').fadeOut(5000)

                                                }
                                            })

                                        <?php } else { ?>
                                            window.location = "{{URL::to('account/login')}}"
                                        <?php } ?>
                                    })

                                })
                            </script>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container row pl-25 pt-25 pb-25 pr-25">
            <div class="col l-12 w-100  ">
                <div class=" detail_tabss d-flex mrl-15">
                    <div class="fz-20 detail_tabs-items active">
                        Giới Thiệu
                    </div>
                    <div class="fz-20 detail_tabs-items ">
                        Bình Luận
                    </div>
                    <div class="fz-20 detail_tabs-items ">
                        Đánh Giá
                    </div>
                    <div class="fz-20 detail_tabs-items ">
                        D.s Chương
                    </div>
                    <div class="detail_lines"></div>
                </div>
                <div class="detail_tab-contents border-top">
                    <div class="detail_tabs-panes active">
                        <div class="row">
                            <div class="col l-8 w-100">
                                <div class="mb-4">
                                    <div class="content fz-16 fw-400 lh-14x pl-15 pr-15">
                                        <?= $truyen->mota ?>
                                    </div>
                                </div>
                                <table class="table border-bottom mb-4 mt-5">
                                    <tbody>
                                        @if($chuongmoi)
                                        <tr class="row">
                                            <td class="col c-12 ">
                                                <ul class="list-unstyled ">
                                                    <li class="media">
                                                        <div class="media-body fw-600 fz-15">Chương mới:

                                                        </div>
                                                        <div class="pl-3 fz-15">
                                                            <?php
                                                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                            $date1 =  date("$chuongmoi->ngaydang");
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
                                                        </div>
                                                    </li>
                                                    <li class="w-100 mt-2 pl-2">
                                                        <a class="fw-400 w-100" href="{{URL::to('/truyen/'.$truyen->slug.'/chuong-'.$chuongmoi->slug)}}">
                                                            Chương {{$chuongmoi->slug}}: <span class="text-primary lh-14x">{{$chuongmoi->tenchuong}}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col l-4 w-100 ">
                                <div class="author-body-left bg-yelow-while brt-5 pt-25 pb-25 pl-25 pr-25">
                                    <div class="author-avt position-relative nh-avatar nh-avatar--90 mx-auto pt-25 mb-20">
                                        <a class="link text-center d-block">
                                            <img class="br-50 w-100" src="{{asset('public/uploads/cus_avt/'.$truyen->nguoidang->avatar)}}" alt="{{$truyen->nguoidang->username}}">
                                        </a>
                                    </div>
                                    <div class="author-name fw-500 fz-16 lh-14x mb-20 text-center">
                                        {{$truyen->nguoidang->username}}
                                    </div>
                                    <div class="author-gr-form row margin-x-0 text-center">
                                        <div class="col l-4 m-4 c-4 pading-x-0">
                                            <i class="ti-book fz-20 fw-500 text-primary"></i>
                                            <div class="fz-15 fw-400 lh-14x mt-2 mb-2">Số truyện</div>
                                            <div class="fw-500 fz-16 lh-14x text-center">{{$count_book}}</div>
                                        </div>
                                        <div class="col l-4 m-4 c-4 pading-x-0">
                                            <i class="ti-layout-media-right-alt fz-20 fw-500 text-primary"></i>
                                            <div class="fz-15 fw-400 lh-14x mt-2 mb-2">Số chương</div>
                                            <div class="fw-500 fz-16 lh-14x text-center">{{$total_chap}}</div>
                                        </div>
                                        <div class="col l-4 m-4 c-4 pading-x-0">
                                            <i class="ti-bolt fz-20 fw-500 text-primary"></i>
                                            <div class="fz-15 fw-400 lh-14x mt-2 mb-2">Cấp</div>
                                            <div class="fw-500 fz-16 lh-14x text-center">{{$truyen->nguoidang->lever}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nh-slider slider-x bg-yelow-while brb-5 pt-25 brb-5 mb-20 " style="overflow: hidden;">
                                    <div class="swiper mySwiper brb-5">
                                        <div class="swiper-wrapper">
                                            @foreach($truyencungnguoidang as $key => $val)
                                            <div class="swiper-slide bg-yelow-while">
                                                <div class="row">
                                                    <div class="col l-12 w-100">
                                                        <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-block w-100 mb-20">
                                                            <img class="w-150 h-auto mx-auto" src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" alt="{{$val->tentruyen}}">
                                                        </a>
                                                        <h2 class="mb-20">
                                                            <a class="fw-600 fz-14 lh-14x " href="{{URL::to('/truyen/'.$val->slug)}}">
                                                                {{$val->tentruyen}}
                                                            </a>
                                                        </h2>
                                                        <div class="fw-400 fz-15 lh-14x mb-20 text-secondary text-overflow-3-lines pl-25 pr-25">
                                                            <?= $val->mota ?>
                                                        </div>
                                                        <div class="mb-50">
                                                            <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}">
                                                                <span class=" fz-15 text-primary border border-primary py-8 pr-25 pl-25">
                                                                    {{$val->theloai->tentheloai}}
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-prev fz-50 text-primary" style="background-image: none;"><i class="ti-angle-left"></i></div>
                                        <div class="swiper-button-next fz-50 text-primary" style="background-image: none;"><i class="ti-angle-right"></i></div>

                                    </div>
                                </div>
                                <div class="bookAuthor">
                                    <div class="mb-3 border-bottom pb-15">
                                        <h2 class="fz-14 fw-600 lh-14x">Truyện cùng tác giả</h2>
                                    </div>
                                    <ul class="bookAuthor-list">
                                        @foreach($truyencungtacgia as $key => $val)
                                        <li class="bookAuthor-items mb-3">
                                            <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-flex">
                                                <div class="w-32 mr-3">
                                                    <img src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" class="w-100 shadow" alt="{{$val->tentruyen}}">
                                                </div>
                                                <div class="pt-">
                                                    <h2 class="fz-12 text-black fw-500 mb-2 lh-14x">{{$val->tentruyen}}</h2>
                                                    <div class="fz-12 text-secondary fw-500">
                                                        <i class="ti-wallet"></i> {{$val->theloai->tentheloai}}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail_tabs-panes ">
                        <div class="row">
                            <div class="col l-8 m-12 w-100">

                                <div>
                                    <div class="review-input-block">
                                        <form action="">
                                            <textarea id="comment_content" class="form-control rounded-2 border-0 p-3"></textarea>
                                            <button id="send-comment" type="button" class="cur-poi btn-submit bg-primary p-0 rounded-circle d-flex align-items-center justify-content-center text-white br-50">
                                                <i class="nh-icon rotate-75 ti-location-arrow"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="comment position-relative">
                                        <div id="book_cmt_header">
                                            <div class="comment-items media py-3 position-relative">
                                                <div>
                                                    <div class="fz-16 fw-500 text-secondary count " style="top: 35px;">{{$count_cmt}} bình luận</div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="comment-list list-unstyled mt-3 mb-4 border-top" id="comment_show">
                                        </ul>
                                        <div id="load_data_message" class="mb-3 " style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-4 m-0">
                                @foreach($rand5slide as $key => $val)
                                <div class="mb-2 cmt_bg" title="{{$val->mota}}" style="background: url({{asset('public/uploads/slide/'.$val->hinhanh)}}) no-repeat; ">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="detail_tabs-panes ">
                        <div class="row">
                            <div class="col l-8 m-12 c-12 w-100">
                                <div>
                                    <div class="review-input-block mb-4">
                                        <form action="">
                                            <label for="" class="fw-500 fz-16">Chọn số sao bạn muốn</label>
                                            <div id="show_error">
                                            </div>
                                            <div class="form-group mt-3">
                                                <div class="rate">
                                                    <input type="radio" class="rate_val" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 </label>
                                                    <input type="radio" class="rate_val" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 </label>
                                                    <input type="radio" class="rate_val" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 </label>
                                                    <input type="radio" class="rate_val" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 </label>
                                                    <input type="radio" class="rate_val" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 </label>
                                                </div>
                                            </div>
                                            <textarea id="vote_content" placeholder="Đánh giá của bạn về truyện này" class="form-control rounded-2 border-0 p-3" style="height: 100px;"></textarea>
                                            <button type="button" style="bottom: 15%;" id="send-vote" class="cur-poi btn-submit bg-primary p-0 rounded-circle d-flex align-items-center justify-content-center text-white br-50">
                                                <i class="nh-icon rotate-75 ti-location-arrow"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="comment">
                                        <div id="book_cmt_header">
                                            <div class="comment-items media py-3 position-relative">
                                                <div>
                                                    <div class="fz-16 fw-500 text-secondary count " style="top: 35px;">{{count($count_vote)}} đánh giá</div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="comment-list list-unstyled mt-3 mb-4 border-top" id="vote_show">

                                        </ul>
                                        <div id="load_data_vote" class="mb-3 " style="width: 100%">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-4 m-0 c-0">
                                <div class="bg-yelow-while br-5 pl-25 pr-25 pb-25 pt-25">
                                    <div class="fz-14 fw-600 mb-4">Lưu ý khi đánh giá</div>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3">1. Không được dẫn link hoặc nhắc đến website khác</p>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3">2. Không được có những từ ngữ gay gắt, đả kích, xúc phạm người khác</p>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3">3. Đánh giá hoặc bình luận không liên quan tới truyện sẽ bị xóa</p>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3">4. Đánh giá hoặc bình luận chê truyện một cách chung chung không mang lại giá trị cho người đọc sẽ bị xóa</p>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3">5. Đánh giá có điểm số sai lệch với nội dung sẽ bị xóa</p>
                                    <p class="fz-15 fw-400 text-primary lh-14x mb-3"><em>Vui lòng xem và tuân
                                            theo đầy đủ các quy định tại Điều Khoản Dịch Vụ khi sử dụng
                                            websiteXXX</em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            var truyen_id = $('#truyen_id').val()
                            var u_id = $('#u_id').val()
                            var _token = $('input[name="_token"]').val()

                            var limit = 10;
                            var start = 0;
                            var action = 'inactive';

                            load_vote()
                            load_rating()
                            load_comment()

                            function load_rating() {
                                $.ajax({
                                    url: "{{url('/load_rating')}}",
                                    method: "POST",
                                    data: {
                                        truyen_id: truyen_id,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#rating_show').html(data)
                                    }
                                })
                            }

                            function load_vote(limit, start) {
                                $.ajax({
                                    url: "{{url('/load_vote')}}",
                                    method: "POST",
                                    data: {
                                        limit: limit,
                                        start: start,
                                        truyen_id: truyen_id,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#vote_show').append(data)
                                        if (data == '') {
                                            $('#load_data_vote').fadeOut(1500)
                                            action = 'active';
                                        } else {
                                            $('#load_data_vote').html("<div style='width: 100%;background:#fff;border-radius: 8px;padding:1px;margin-top: 10px;'><p style='font-size: 16px; text-align: center;font-weight: bold;'>Loading</p></div>");
                                            action = "inactive";
                                        }
                                    }
                                })
                            }


                            function load_comment(limit, start) {

                                $.ajax({
                                    url: "{{url('/load_book_comment')}}",
                                    method: "POST",
                                    data: {
                                        limit: limit,
                                        start: start,
                                        truyen_id: truyen_id,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#comment_show').append(data)
                                        if (data == '') {
                                            $('#load_data_message').fadeOut(1500)
                                            action = 'active';
                                        } else {
                                            $('#load_data_message').html("<div style='width: 100%;background:#fff;border-radius: 8px;padding:1px;margin-top: 10px;'><p style='font-size: 16px; text-align: center;font-weight: bold;'>Loading</p></div>");
                                            action = "inactive";
                                        }
                                    }
                                })
                            }

                            if (action == 'inactive') {
                                action = 'active';
                                load_comment(limit, start);
                                load_vote(limit, start);
                            }
                            $(window).scroll(function() {
                                if ($(window).scrollTop() + $(window).height() > $("#comment_show").height() && action == 'inactive') {
                                    action = 'active';
                                    start = start + limit;
                                    setTimeout(function() {
                                        load_comment(limit, start);
                                        load_vote(limit, start)
                                    }, 1500);
                                }
                            });
                            $('#send-vote').click(function(e) {
                                e.preventDefault()
                                <?php
                                if (isset($cus_id)) {
                                ?>
                                    const rate = $('input[type="radio"][name="rate"].rate_val:checked').val();
                                    const vote_content = $('#vote_content').val()
                                    $.ajax({
                                        url: "{{url('/send_vote')}}",
                                        method: "POST",
                                        data: {
                                            truyen_id: truyen_id,
                                            u_id: u_id,
                                            vote_content: vote_content,
                                            rate: rate,
                                            _token: _token
                                        },
                                        success: function(data) {
                                            $('.vote_x').remove()
                                            load_vote(limit, start = 0)
                                            load_rating()
                                            $('#vote_content').val('')
                                            $('input[type="radio"][name="rate"].rate_val:checked').val('')
                                            $('#show_error').html(data)
                                            $('.alert').fadeOut(7000)
                                        }
                                    })

                                <?php } else { ?>
                                    window.location = "{{URL::to('account/login')}}"
                                <?php } ?>
                            })
                            $('#send-comment').click(function(e) {
                                e.preventDefault()
                                <?php
                                if (isset($cus_id)) {
                                ?>
                                    const comment_content = $('#comment_content').val()
                                    $.ajax({
                                        url: "{{url('/send_book_comment')}}",
                                        method: "POST",
                                        data: {
                                            truyen_id: truyen_id,
                                            u_id: u_id,
                                            comment_content: comment_content,
                                            _token: _token
                                        },
                                        success: function(data) {
                                            $('#comment_content').val('')
                                            $('.cmt_x').remove()
                                            load_comment(limit, start = 0);
                                        }
                                    })

                                <?php } else { ?>
                                    window.location = "{{URL::to('account/login')}}"
                                <?php } ?>
                            })
                            $(document).on('click', '.delete_vote_btn', function(e) {
                                e.preventDefault()
                                var vote_id = $(this).data('vote_id')
                                // alert(truyen_id)

                                if (confirm('Bạn có muốn xóa?') == true) {
                                    $.ajax({
                                        url: "{{url('/delete_vote')}}",
                                        method: "POST",
                                        data: {
                                            truyen_id: truyen_id,
                                            vote_id: vote_id,
                                            _token: _token
                                        },
                                        success: function(data) {
                                             $('.vote_x').remove()
                                             load_vote(limit, start = 0)
                                            load_rating()
                                            $('#notify').html(data)
                                            $('.alert-form').fadeOut(5000)
                                        }
                                    })
                                }

                            })
                        })
                    </script>
                    <div class="detail_tabs-panes">
                        <div class="chapter-list">
                            <div class="d-flex mb-3 lh-15">
                                <h2 class="fw-500 fz-16 ">Danh sách chương</h2>
                            </div>
                            <div class="chapter-items">
                                <div class="row">
                                    @foreach($toanbochuong as $key => $val)
                                    <div class="col l-4 m-6 c-12 border-bottom-dashed pt-1 pb-1">
                                        <a href="{{URL::to('/truyen/'.$truyen->slug.'/chuong-'.$val->slug)}}" class="chapter-link d-block fz-15 fw-400 lh-14x webkit-line-clamp-1 text-secondary pt-1 pb-1 pr-10 pl-10">
                                            Chương {{$key+1}}: {{$val->tenchuong}}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</main>
@endsection