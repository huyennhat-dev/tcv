@extends('../home')

@section('content')
<main class="main" id="demo" style="background: url('../public/uploads/slide/<?= $slide->hinhanh ?>') no-repeat;">
    <div class="container row mb-20 mt-50 background-sl">

    </div>
    <div class="grid wide">
        <div class="container row category">
            <div class="col l-3 m-0 c-0 pt-12">
                <aside class="fz-13">
                    <div class=" border-bottom" style="padding-top: 11px;">
                        <div class="fw-500 fz-16 mt-1 mb-2">Thể loại</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            @foreach($theloai as $key => $val)
                            <li>
                                <a href="{{url('the-loai/'.$val->slug)}}" class="item rounded br-5">
                                    <small>{{$val->tentheloai}}</small>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="py-2 border-bottom">
                        <div class="fw-500 fz-16 mt-1 mb-2">Tình trạng</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            <li><a href="{{URL::to('/trang-thai/0')}}" class="item rounded br-5"><small>Đang ra</small></a></li>
                            <li><a href="{{URL::to('/trang-thai/1')}}" class="item rounded br-5"><small>Hoàn thành</small></a></li>
                        </ul>
                    </div>
                    <div class="py-2 border-bottom">
                        <div class="fw-500 fz-16 mt-1 mb-2">Tính cách nhân vật chính</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            @foreach($tinhcach as $key => $val)
                            <li>
                                <a href="{{url('tinh-cach-nhan-vat/'.$val->slug)}}" class="item rounded br-5">
                                    <small>{{$val->tentinhcach}}</small>

                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="py-2 border-bottom">
                        <div class="fw-500 fz-16 mt-1 mb-2">Bối cảnh thế giới</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            @foreach($thegioi as $key => $val)
                            <li>
                                <a href="{{url('boi-canh-the-gioi/'.$val->slug)}}" class="item rounded br-5">
                                    <small>{{$val->tenthegioi}}</small>

                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="py-2 border-bottom">
                        <div class="fw-500 fz-16 mt-1 mb-2">Lưu phái</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            @foreach($luuphai as $key => $val)
                            <li>
                                <a href="{{url('luu-phai/'.$val->slug)}}" class="item rounded br-5">
                                    <small>{{$val->tenluuphai}}</small>

                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="py-2 border-bottom">
                        <div class="fw-500 fz-16 mt-1 mb-2">Thị giác</div>
                        <ul class="list-facet list-unstyled d-flex flex-wrap m-0">
                            <li><a href="{{url('thi-giac/0')}}" class="item rounded br-5"><small>Truyện Nam</small></a></li>
                            <li><a href="{{url('thi-giac/1')}}" class="item rounded br-5"><small>Truyện Nữ</small></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col l-9 m-12 c-12 pt-12">
                <div class="appreciate w-100">
                    <div class="heading" style="height:auto;">
                        <div class="py-2 w-100" style="border-bottom: 1px solid #eee !important;">
                            <div class="fw-500 fz-16 mt-1 mb-2">Đang tìm</div>
                            <div class="d-flex justify-content-between" style="align-items: center;">
                                <ul class="list-facet list-unstyled d-flex flex-wrap m-0 mb-0">
                                    <li style="margin:0;">
                                        <a href="" class="item rounded br-5 active">
                                            <small>
                                               {{$theloai_id->tentheloai}}
                                             </small>
                                        </a>
                                    </li>
                                </ul>
                                <i onclick="panel_btn()" id="panel_btn" class="ti-panel"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($truyen as $key => $val)
                    <div class="col l-6 m-6 c-12  border-bottom pb-25 pt-25 pl-15 pr-15">
                        <div class="media">
                            <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--90 shadow mr-3">
                                <img src="../public/uploads/truyen/{{$val->hinhanh}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}" width="90">
                            </a>
                            <div class="media-body">
                                <h2 class="fz-13 fw-500  mb-8">
                                    <a href="{{URL::to('/truyen/'.$val->slug)}}"  class="d-block lh-14x">
                                        {{$val->tentruyen}}</a>
                                </h2>

                                <div class="text-secondary fz-13 mb-8 text-overflow-2-lines lh-15">
                                    <?= $val->mota ?>
                                </div>
                                <div class="d-flex align-items-center mt-2 py-1 jus-between">
                                    <div class=" align-items-center mr-auto text-secondary">
                                        <span class="truncate-140 text-left text-black fz-12  mb-8">
                                            <i class="nh-icon ti-pencil-alt2 mr-1"></i>
                                            {{$val->tacgia}}
                                        </span>
                                        <p style="height: 8px;"></p>
                                        <span class="truncate-140 text-left text-black fz-12  mb-8">
                                            <i class="nh-icon ti-menu mr-1"></i>
                                            {{$count_chap_x[$key]}} Chương
                                        </span>
                                    </div>
                                    <a >
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
                <div class="row mt-3">
                    <div class="col l-12 w-100 pagi-nav">
                        {{$truyen->onEachSide(1)->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection