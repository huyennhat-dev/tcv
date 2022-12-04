@extends('../layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('library')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('list_account')}}">Danh Sách Khách Hàng</a></li>
                        <li class="breadcrumb-item active">Hồ Sơ {{$account->username}}</li>
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
                <div class="col-md-4 col-12">
                    <!-- Profile Image -->
                    <div class="card ">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php $avata = "this.src='https://alfafafoods.com/wp-content/uploads/2020/10/PngJoy_gray-circle-login-user-icon-png-transparent-png_2750635-1.png'"; ?>
                                <img width="100" height="100" class="profile-user-img img-fluid img-circle" onerror="{{$avata}}" src="{{asset('public/uploads/cus_avt/'.$account->avatar)}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$account->username}}</h3>
                            <p class="text-muted text-center">
                                Tham gia {{$account->joindate}}
                            </p>

                            <div class="text-muted text-center">
                                <?= $account->introduce ?>
                            </div>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Cấp</b> <a class="float-right text-black">{{$account->lever}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Giới tính</b> <a class="float-right text-black">
                                        @if($account->sex == 0)
                                        Bí Mật
                                        @elseif($account->sex==1)
                                        Nam
                                        @else
                                        Nữ
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số truyện</b> <a class="float-right text-black">{{$count_book}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số chương</b> <a class="float-right text-black">{{$total_chap}}</a>
                                </li>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block"><i class="ti-comments"></i> Nhắn tin</a> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8 col-12">
                    <div class="card  card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-black" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                                        Đang Ra
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                                        Hoàn Thành
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <table class="table">
                                        <tbody>
                                            @if(count($truyendangra)>=1)
                                            @foreach($truyendangra as $key => $val)
                                            <tr>
                                                <td class="border ">
                                                    <div class="d-flex">
                                                        <div>
                                                            <img width="100" src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}">
                                                        </div>
                                                        <div class="ml-3 ">
                                                            <h5>
                                                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="text-primary fw-500 fz-20">
                                                                    {{$val->tentruyen}}
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <a class="btn btn-outline-danger btn-circle  lh-15 px-2" style="width: auto; ">{{$val->theloai->tentheloai}}</a>
                                                            </div>
                                                            <div class="mt-2 webkit-line-clamp-2 mb-0 text-secondary">
                                                                <?= $val->mota ?>
                                                            </div>
                                                            <p class="mb-0">
                                                                <i class="text-secondary fa fa-copyright"></i> {{$val->sochuong}}
                                                                <i class="text-secondary fa fa-eye m-l-10"></i> {{$val->luotxem}}
                                                                <i class="text-secondary fa fa-star m-l-10"></i> {{$val->sosao}}
                                                                <i class="text-secondary fa fa-comments m-l-10"></i> {{$val->sobinhluan}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center" colspan="2"><strong>Không có truyện</strong></td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{$truyendangra->onEachSide(1)->links('pagination::bootstrap-4')}}
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <table class="table">
                                        <tbody>
                                            @if(count($truyenhoanthanh)>=1)
                                            @foreach($truyenhoanthanh as $key => $val)
                                            <tr>
                                                <td class="border ">
                                                    <div class="d-flex">
                                                        <div>
                                                            <img width="100" src="{{asset('public/uploads/truyen/'.$val->hinhanh)}}" title="{{$val->tentruyen}}" alt="{{$val->tentruyen}}">
                                                        </div>
                                                        <div class="ml-3 ">
                                                            <h5>
                                                                <a href="{{URL::to('/truyen/'.$val->slug)}}" class="text-primary fw-500 fz-20">
                                                                    {{$val->tentruyen}}
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <a class="btn btn-outline-danger btn-circle  lh-15 px-2" style="width: auto; ">{{$val->theloai->tentheloai}}</a>
                                                            </div>
                                                            <div class="mt-2 webkit-line-clamp-2 mb-0 text-secondary">
                                                                <?= $val->mota ?>
                                                            </div>
                                                            <p class="mb-0">
                                                                <i class="text-secondary fa fa-copyright"></i> {{$val->sochuong}}
                                                                <i class="text-secondary fa fa-eye m-l-10"></i> {{$val->luotxem}}
                                                                <i class="text-secondary fa fa-star m-l-10"></i> {{$val->sosao}}
                                                                <i class="text-secondary fa fa-comments m-l-10"></i> {{$val->sobinhluan}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="text-center" colspan="2"><strong>Không có truyện</strong></td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{$truyenhoanthanh->onEachSide(1)->links('pagination::bootstrap-4')}}

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