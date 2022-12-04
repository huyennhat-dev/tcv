@extends('../home')

@section('content')
<main class="main" id="demo" style="background: url({{asset('public/uploads/slide/'.$slide->hinhanh)}}) no-repeat;">
    <div class="container row mb-20 mt-50 background-sl">

    </div>
    <div class="grid wide chitiettruyen xep_hang">
        <div class="container row detail">
            <div class="col l-3 m-12 c-12 w-100 bg-while" style="padding-top: 27px;">
                <div class="body-rank-menu  w-100 pr-15 pl-15">
                    <ul class="rank-menu-list w-100">
                        <li class="rank-menu_items active">
                            <a href="{{URL::to('/xep-hang/doc-nhieu')}}" class="rank-menu_link fz-14 fw-500">
                                <i class="ti-eye"></i> <span class="d-none-mb">Đọc Nhiều</span></a>
                        </li>
                        <li class="rank-menu_items">
                            <a href="{{URL::to('/xep-hang/de-cu')}}" class="rank-menu_link fz-14 fw-500">
                                <i class="ti-star"></i> <span class="d-none-mb">Đề Cử</span></a>
                        </li>
                        <li class="rank-menu_items ">
                            <a href="{{URL::to('/xep-hang/danh-gia')}}" class="rank-menu_link fz-14 fw-500">
                                <i class="ti-receipt"></i> <span class="d-none-mb">Đánh giá</span></a>
                        </li>
                        <li class="rank-menu_items">
                            <a href="{{URL::to('/xep-hang/thao-luan')}}" class="rank-menu_link fz-14 fw-500">
                                <i class="ti-comment"></i> <span class="d-none-mb">Thảo Luận</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l-9 m-12 c-12 bg-while " style="padding-top: 27px;">
                @foreach($truyen as $key =>$val)
                <div class="row">
                    <div class="col l-12 m-12 c12 border-bottom pb-25  pl-15 pr-15">
                        <div class="media">
                            <a href="{{URL::to('/truyen/'.$val->slug)}}" class="nh-thumb nh-thumb--90 shadow mr-3">
                                <img src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}" width="90">
                            </a>
                            <div class="media-body">
                                <h2 class="fz-13 fw-500  mb-8">
                                    <a href="{{URL::to('/truyen/'.$val->slug)}}" class="d-block lh-14x">{{$val->tentruyen}}</a>
                                </h2>
                                <div class="text-align-jus text-secondary fz-13 text-overflow-3-lines lh-15"> 
                                    <?=$val->mota?>
                                </div>
                                <div class="d-flex align-items-center py-1 ">
                                    <div class=" align-items-center mr-auto text-secondary">
                                        <div class="d-flex mb-8 align-items-center" style="justify-content: space-between;"><span class="d-flex align-items-center text-tertiary fz-15">
                                                <ul class="list-inline d-flex position-relative rating mb-0 ">
                                                    <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                    <li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">★</li>
                                                    <ul class="d-flex active" style="width: {{$val->sosao*100/5}}%;">
                                                        <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                        <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                        <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                        <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                        <li class="mr-1" style="color:#ffc000 ; font-size: 15px;">★</li>
                                                    </ul>
                                                </ul>
                                            </span>
                                            <span class="detail_vote d-inline-block fz-12 text-success ml-2"> ( {{$total_vote[$key] }} đánh giá)</span>
                                        </div>
                                        <span class="truncate-140 text-left text-black fz-12  mb-8">
                                            <i class="nh-icon ti-pencil-alt2 mr-1"></i>
                                            {{$val->tacgia}}
                                        </span>
                                        <p style="height: 8px;"></p>
                                       <div>
                                            <span class="truncate-140 text-left text-black fz-12  mb-8">
                                            <i class="nh-icon ti-eye mr-1"></i>
                                            {{$val->luotxem}} 
                                            </span>
                                            <span class="truncate-140 text-left text-black fz-12  mb-8">
                                            <i class="nh-icon ti-menu ml-2"></i>
                                            {{$count_chap_x[$key]}} Chương
                                        </span>
                                        </div>
                                        <p style="height: 8px;"></p>
                                        <span>
                                            <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}" class="sp-none">
                                                <span class="d-inline-block border fz-12 border-primary small px-2 py-8 text-primary truncate-150">{{$val->theloai->tentheloai}}</span>
                                            </a>
                                        </span>
                                    </div>
                                    <a href="{{URL::to('/the-loai/'.$val->theloai->slug)}}" class="ml-100 d-none-mb">
                                        <span class="d-inline-block border fz-12 border-primary small px-2 py-8 text-primary truncate-150">{{$val->theloai->tentheloai}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
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