@extends('../home')

@section('content')
<?php

use Illuminate\Support\Facades\Session;
?>
<main class="main" id="demo" style="background: url({{asset('public/uploads/slide/'.$slide->hinhanh)}}) no-repeat;">
    <div class="container row mb-20 mt-50 background-sl">
    </div>
    <div class="grid wide">
        <div class="container row mb-20 br-5">
            <div class="chapter_detail-content col l-12 m-12 c-12 bg-chuong br-5 pt-25 pb-25 pl-50 pr-50">
                <div class="row mb-4 ">
                    <div class="col l-3 m-5 c-6">
                        <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$prev_chapter)}}" class="d-block {{($min_id->id === $chuong->id)?'disabled':''}}">
                            <div class="chapter_prev bg-yelow-while br-5 pt-15 pb-15 pr-15 pl-15 text-center fz-16 fw-500 lh-15">
                                <i class="ti-arrow-left fw-600"></i> Chương trước
                            </div>
                        </a>
                    </div>
                    <div class="col l-6 m-2 c-0"></div>
                    <div class="col l-3 m-5 c-6 ">
                        <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$next_chapter)}}" class="d-block {{($max_id->id === $chuong->id)?'disabled':''}}">
                            <div class="chapter_next bg-yelow-while br-5 pt-15 pb-15 pr-15 pl-15 text-center fz-16 fw-500 lh-15">
                                Chương sau <i class="ti-arrow-right fw-600"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row  border-bottom-black-color ">
                    <div class="col l-12 mb-3 mt-3">
                        <div class="fw-500 fz-25 lh-15x">Chương {{$chuong->slug}}: {{ucwords($chuong->tenchuong)}}</div>
                    </div>
                    <div class="col l-12  ">
                        <div class="fz-16 fw-400 lh-14x ml-2 mr-4">Người đăng: {{ucwords($truyen->nguoidang->username)}}</div>
                        <div class="fz-16 fw-400 lh-14x ml-2 mr-4">Tác giả: {{ucwords($truyen->tacgia)}}</div>
                        <div class="fz-16 fw-400 lh-14x ml-2 mr-4">Ngày đăng: {{$chuong->ngaydang}}</div>
                    </div>
                    <div class="col l-12 d-flex mb-3 mt-2">
                        <div class="row ml-2">
                            <div class="fz-16 fw-400 lh-14x mr-4">
                                <a href="{{URL::to('/truyen/'.$truyen->slug)}}"> <i class="ti-agenda"></i> {{ucwords($truyen->tentruyen)}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-20 border-bottom-black-color pb-25">
                    <div class="col l-12">
                        <div class="fz-20  lh-15x">
                            <?= $chuong->noidung ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-50 mb-3">
                    <div class="col l-3 m-5 c-6">
                        <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$prev_chapter)}}" class="d-block {{($min_id->id === $chuong->id)?'disabled':''}}">
                            <div class="chapter_prev bg-yelow-while br-5 pt-15 pb-15 pr-15 pl-15 text-center fz-16 fw-500 lh-15">
                                <i class="ti-arrow-left fw-600"></i> Chương trước
                            </div>
                        </a>
                    </div>
                    <div class="col l-6 m-2 c-0"></div>
                    <div class="col l-3 m-5 c-6 ">
                        <a href="{{url('truyen/'.$truyen->slug.'/chuong-'.$next_chapter)}}" class="d-block {{($max_id->id === $chuong->id)?'disabled':''}}">
                            <div class="chapter_next bg-yelow-while br-5 pt-15 pb-15 pr-15 pl-15 text-center fz-16 fw-500 lh-15">
                                Chương sau <i class="ti-arrow-right fw-600"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col l-12 m-12 c-12 pl-15 pr-15">
                        <div class="review-input-block mb-4">
                            <form>
                                <?php
                                $cus_name = Session::get('cus_name');
                                $cus_avt = Session::get('cus_avatar');
                                $cus_id = Session::get('cus_id');

                                ?>
                                <input type="hidden" value="{{$cus_name}}" id="comment_name">
                                <input type="hidden" value="{{$cus_avt}}" id="cus_avt">
                                <input type="hidden" name="comment_truyen_id" id="comment_truyen_id" value="{{$truyen->id}}">
                                <input type="hidden" name="comment_chuong_id" id="comment_chuong_id" value="{{$chuong->id}}">
                                <textarea id="comment_content" placeholder="Đánh giá của bạn về truyện này" class="form-control rounded-2 border-0 p-3" style="height: 100px;"></textarea>
                                <button type="button" id="send-comment" class="cur-poi  btn-submit bg-primary p-0 rounded-circle d-flex align-items-center justify-content-center text-white br-50">
                                    <i class="nh-icon rotate-75 ti-location-arrow"></i>
                                </button>
                            </form>
                        </div>
                        <div class="comment">
                            @csrf
                            <div id="book_cmt_header">
                                <div class="comment-items media py-3 position-relative">
                                    <div>
                                        <div class="fz-16 fw-500 text-secondary count " style="top: 35px; background-color: #f7f2e8;">{{count($count_cmt)}} bình luận</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="comment-list list-unstyled mt-3 mb-4 border-top" id="comment_show">
                            </ul>
                            <div id="load_data_cmt" class="mb-3 " style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var truyen_id = $('#comment_truyen_id').val()
                    var chuong_id = $('#comment_chuong_id').val()
                    var _token = $('input[name="_token"]').val()


                    var limit = 10;
                    var start = 0;
                    var action = 'inactive';


                    load_comment()

                    function load_comment(limit, start) {
                        $.ajax({
                            url: "{{url('/load_comment')}}",
                            method: "POST",
                            data: {
                                limit: limit,
                                start: start,
                                truyen_id: truyen_id,
                                chuong_id: chuong_id,
                                _token: _token
                            },
                            success: function(data) {
                                $('#comment_show').append(data)
                                if (data == '') {
                                    $('#load_data_cmt').fadeOut(1500)
                                    action = 'active';
                                } else {
                                    $('#load_data_cmt').html("<div style='width: 100%;background:#fff;border-radius: 8px;padding:1px;margin-top: 10px;'><p style='font-size: 16px; text-align: center;font-weight: bold;'>Loading</p></div>");
                                    action = "inactive";
                                }
                            }
                        })
                    }
                    if (action == 'inactive') {
                        action = 'active';
                        load_comment(limit, start);
                    }
                    $(window).scroll(function() {
                        if ($(window).scrollTop() + $(window).height() > $("#comment_show").height() && action == 'inactive') {
                            action = 'active';
                            start = start + limit;
                            setTimeout(function() {
                                load_comment(limit, start);
                            }, 1500);
                        }
                    });
                    $('#send-comment').click(function(e) {
                        e.preventDefault()
                        <?php
                        if (isset($cus_id)) {
                        ?>
                            const cmt_content = $('#comment_content').val()
                            $.ajax({
                                url: "{{url('/send_comment')}}",
                                method: "POST",
                                data: {
                                    truyen_id: truyen_id,
                                    chuong_id: chuong_id,
                                    cmt_content: cmt_content,
                                    _token: _token
                                },
                                success: function(data) {
                                    $('#comment_content').val('')
                                    $('.chap_cmt_x').remove()
                                    load_comment(limit, start = 0)
                                }
                            })
                        <?php } else { ?>
                            window.location = "{{URL::to('account/login')}}"
                        <?php } ?>
                    })
                    $(document).on('click', '#load_more_btn', function() {
                        const id = $(this).data('id')
                        load_comment(id)
                    })

                })
            </script>

        </div>
    </div>
</main>
@endsection