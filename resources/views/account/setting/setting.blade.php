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
                                    <a class="nav-link active text-black" data-toggle="pill" href="#tab_1" role="tab" aria-selected="true">Hồ Sơ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" data-toggle="pill" href="#tab_2" role="tab" aria-selected="false">Bảo Mật</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-black" data-toggle="pill" href="#tab_3" role="tab" aria-selected="false">Thông Báo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" data-toggle="pill" href="#tab_4" role="tab" aria-selected="false">Tủ Truyện</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" data-toggle="pill" href="#tab_5" role="tab" aria-selected="false">Thanh Toán</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                                    <form action="{{URL::to('/account/update_profile')}}" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="px-2">
                                                    <h4 class="m-0">Cấp 1 <a href="{{route('faqs')}}"><span class="text-muted fa fa-question-circle"></span></a></h4>
                                                    <small>25/100</small>
                                                    <div class="progress progress-xs progress-striped active" style="height: 15px;">
                                                        <div class="progress-bar bg-primary" style="width: 25%; height: 15px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="px-2">
                                                    <div>Hình đại diện</div>
                                                    <div class="mt-2">
                                                        <label for="imageUpload" style="cursor: pointer;">
                                                            <div class="avatar-preview container2 d-flex">
                                                                @php
                                                                if(!empty($image->image) && $image->image!='' && file_exists(public_path('images/'.$image->image))){
                                                                $image =$image->image;
                                                                }else{
                                                                $image = 'cus_avt/'.$account->avatar;
                                                                }
                                                                $url = url('public/uploads/'.$image);
                                                                $imgs = "background:url($url) no-repeat";
                                                                @endphp
                                                                <div id="imagePreview" class=" s-100" style="<?= $imgs ?>">
                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                    <input style="margin-top: 60px;" type="button" class="d-none">
                                                                </div>
                                                                <div style="padding: 30px 0;">
                                                                    <div class="btn btn-outline-primary ml-2" style="height: 40px;">
                                                                        Đổi
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input type="file" name="hinhanh" id="imageUpload" class="d-none">
                                                        <input type="hidden" name="base64image" name="base64image" id="base64image">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <p for="userName">Tên Hiển Thị </p>
                                                <input type="text" name="tenhienthi" class="form-control form-control-border" id="userName" value="{{$account->username}}">
                                            </div>
                                            <div class="form-group">
                                                <p for="dateOfiBrth">Năm Sinh</p>
                                                <input type="date" name="namsinh" class="form-control form-control-border border-width-2" id="dateOfiBrth" value="{{$account->yearofbirth}}">
                                            </div>
                                            <div class="form-group">
                                                <p for="sex">Giới Tính</p>
                                                <select name="gioitinh" class="custom-select form-control-border" id="sex">
                                                    @if($account->sex == 0)
                                                    <option selected value="0">Bí Mật</option>
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                    @elseif($account->sex == 1)
                                                    <option value="0">Bí Mật</option>
                                                    <option selected value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                    @else
                                                    <option value="0">Bí Mật</option>
                                                    <option value="1">Nam</option>
                                                    <option selected value="2">Nữ</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p for="introduce">Giới Thiệu Ngắn</p>
                                                <textarea name="mota" class="form-control form-control-border border-width-2" id="introduce" rows="2">
                                                {{$account-> introduce }}
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <p for="email">Email</p>
                                                <input readonly type="email" class="form-control form-control-border border-width-2" id="dateOfiBrth" value="{{$account->email}}">
                                            </div>
                                            <div class="form-group">
                                                <p for="numberPhone">Số Điện Thoại</p>
                                                <input type="number" name="sodienthoai" value="{{$account->numberphone}}" class="form-control form-control-border border-width-2" id="numberPhone" placeholder="Không bắt buôc, thêm sđt để bảo mật hơn">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Cập Nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab_2" role="tabpanel">
                                    <form method="POST" action="{{URL::to('/account/changepass')}}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <p for="currentPass">Mật Khẩu Hiện Tại </p>
                                                <input type="password" class="form-control form-control-border" name="currentPass" id="currentPass" placeholder="Phải nhập mật khẩu hiện tại nếu muốn đổi mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <p for="newPass">Mật Khẩu Mới</p> <span class="ml-3" id="strength"></span>
                                                </div>
                                                <script language="javascript">
                                                    function passwordChanged() {
                                                        var strength = document.getElementById('strength');
                                                        var strongRegex = new RegExp("^(?=.{14,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
                                                        var mediumRegex = new RegExp("^(?=.{10,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
                                                        var enoughRegex = new RegExp("(?=.{8,}).*", "g");
                                                        var pwd = document.getElementById("password");
                                                        if (pwd.value.length == 0) {
                                                            strength.innerHTML = '';
                                                        } else if (false == enoughRegex.test(pwd.value)) {
                                                            strength.innerHTML = 'Mật khẩu ít nhất 8 kí tự';
                                                        } else if (strongRegex.test(pwd.value)) {
                                                            strength.innerHTML = '<span style="color:green">Mạnh!</span>';
                                                        } else if (mediumRegex.test(pwd.value)) {
                                                            strength.innerHTML = '<span style="color:orange">Bình Thường!</span>';
                                                        } else {
                                                            strength.innerHTML = '<span style="color:red">Quá Yếu!</span>';
                                                        }
                                                    }
                                                </script>
                                                <input type="password" onkeyup="return passwordChanged();" class="form-control form-control-border border-width-2" name="newPass" id="password" placeholder="Nhập mật khẩu mới">

                                            </div>
                                            <div class="form-group">
                                                <p for="repeatNewPass">Nhập Lại Mật Khẩu Mới</p>
                                                <input type="password" class="form-control form-control-border border-width-2" name="repeatNewPass" id="repeatNewPass" placeholder="Nhập lại mật khẩu mới">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" onsubmit="changepasss()" class="btn btn-primary changepass">Cập Nhật</button>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab_3" role="tabpanel">
                                    <div class="px-3">
                                        <div class="form-group d-flex ">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" style="cursor: pointer;" id="customSwitch1">
                                                <label class="custom-control-label" for="customSwitch1"></label>
                                            </div>
                                            <div class="ml-2">
                                                <h5>Báo chương mới</h5>
                                            </div>
                                        </div>
                                        <p class="text-secondary">Bạn sẽ nhận được thông báo khi truyện đang theo dõi có chương mới.</p>
                                    </div>
                                    <hr>
                                    <div class="px-3">
                                        <div class="form-group d-flex ">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" style="cursor: pointer;" id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
                                            <div class="ml-2">
                                                <h5>Báo tương tác: bình luận, thích...</h5>
                                            </div>
                                        </div>
                                        <p class="text-secondary">Bạn sẽ nhận được thông báo khi có các bình luận liên quan đến bạn.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_4" role="tabpanel">
                                    <form action="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <p for="reading">Sắp Xếp Theo Truyện Đang Đọc </p>
                                                <select class="custom-select form-control-border" id="reading">
                                                    <option value="0">Truyện Mới Cập Nhật</option>
                                                    <option value="1">Truyện Mới Đọc</option>
                                                    <option value="2">Tên Truyện</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p for="tick">Sắp Xếp Theo Truyện Đánh Dấu</p>
                                                <select class="custom-select form-control-border" id="tick">
                                                    <option value="0">Truyện Mới Cập Nhật</option>
                                                    <option value="1">Truyện Mới Thêm</option>
                                                    <option value="2">Tên Truyện</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Cập Nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab_5" role="tabpanel">
                                    <form action="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <p for="userName">Tên Chủ Tài Khoản</p>
                                                <input type="text" class="form-control form-control-border" id="userName" placeholder="Nhập tên chủ tài khoản">
                                            </div>
                                            <div class="form-group">
                                                <p for="accountNumber">Số Tài Khoản</p>
                                                <input type="number" class="form-control form-control-border border-width-2" id="accountNumber" placeholder="Nhập số tài khoản">
                                            </div>
                                            <div class="form-group">
                                                <p for="bank">Ngân Hàng</p>
                                                <input type="text" class="form-control form-control-border" id="bank" placeholder="Nhập tên ngân hàng">
                                            </div>
                                            <div class="form-group">
                                                <p for="branch">Chi Nhánh</p>
                                                <input type="text" class="form-control form-control-border border-width-2" id="branch" placeholder="Nhập chi nhánh ngân hàng">
                                            </div>
                                            <div class="form-group">
                                                <p for="city">Tỉnh / Thành Phố</p>
                                                <input type="text" class="form-control form-control-border border-width-2" id="city" placeholder="Nhập tỉnh/thành phố">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary">Cập Nhật</button>
                                            </div>
                                        </div>
                                    </form>
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