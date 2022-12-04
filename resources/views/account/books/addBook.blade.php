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
                        <li class="breadcrumb-item active">Thêm Truyện Mới</li>
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
                    <div class="card ">
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="px-2">
                                                            <div>Ảnh Bìa </div>
                                                            <div class="mt-2">
                                                                <label for="imageUpload_book" style="cursor: pointer;">
                                                                    <div class="avatar-preview container2 d-flex">
                                                                        @php
                                                                        if(!empty($image->image) && $image->image!='' && file_exists(public_path('images/'.$image->image))){
                                                                        $image =$image->image;
                                                                        }else{
                                                                        $image = 'truyen/default.png';
                                                                        }
                                                                        $url = url('public/uploads/'.$image);
                                                                        $imgs = "background:url($url) no-repeat";
                                                                        @endphp
                                                                        <div id="imagePreview" class=" w-200" style="<?= $imgs ?>">
                                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                            <input style="margin-top: 60px;" type="button" class="d-none">
                                                                        </div>

                                                                    </div>
                                                                </label>
                                                                <input type="file" name="hinhanh" id="imageUpload_book" class="d-none">
                                                                <input type="hidden" name="base64image" name="base64image" id="base64image">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php

                                                use Illuminate\Support\Facades\Session;

                                                $cus_id = Session::get('cus_id');
                                                ?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <p for="name_slug">Tên Truyện </p>
                                                        <input type="text" onkeyup="ChangeToSlug()" name="tentruyen" value="{{old('tentruyen')}}" class="form-control form-control-border" id="name_slug">
                                                    </div>
                                                    <input type="hidden" class="form-control form-control-border" name="slug" id="convert_slug">
                                                    <input type="hidden" class="form-control form-control-border" name="nguoidang_id" value="{{$cus_id}}">
                                                    <div class="form-group">
                                                        <p for="tacgia">Tên Tác Giả </p>
                                                        <input type="text" name="tacgia" value="{{old('tacgia')}}" class="form-control form-control-border" id="tacgia">
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="classify">Phân Loại</p>
                                                        <select name="phanloai" class="custom-select form-control-border" id="classify">
                                                            <option value="0">Truyện Nam</option>
                                                            <option value="1">Truyện Nữ</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="category">Thể loại</p>
                                                        <select name="theloai" class="custom-select form-control-border" id="category">
                                                            @foreach($theloai as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->tentheloai}}</option>
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
                                                        <p><i class="text-secondary">Tối đa 6000 ký tự. Tóm tắt cho truyện không nên quá dài mà nên ngắn gọn, tập trung, thú vị. Phần này rất quan trọng vì nó quyết định độc giả có đọc hay không.</i></p>
                                                        <textarea name="mota" class="form-control form-control-border border-width-2" id="introduce">{{old('mota')}}</textarea>
                                                    </div>
                                                    <hr>
                                                    <p><i>
                                                            Bên dưới là các Nhãn (tag) cho truyện, với mỗi loại nhãn, chỉ được chọn một giá trị, vui lòng xem và chọn Nhãn kỹ lưỡng.
                                                            Nếu nhãn muốn thêm chưa có trong danh sách, vui lòng liên hệ quản trị viên ở mục liên hệ.
                                                        </i></p>
                                                    <div class="form-group">
                                                        <p for="rewarded">Tính Cách Nhân Vật Chính</p>
                                                        <select name="tinhcach" class="custom-select form-control-border" id="rewarded">
                                                            @foreach($tinhcach as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->tentinhcach}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="world">Bối Cảnh Thế Giới</p>
                                                        <select name="thegioi" class="custom-select form-control-border" id="world">
                                                            @foreach($thegioi as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->tenthegioi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p for="sect">Lưu Phái</p>
                                                        <select name="luuphai" class="custom-select form-control-border" id="sect">
                                                            @foreach($luuphai as $key => $val)
                                                            <option value="{{$val->id}}">{{$val->tenluuphai}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group d-flex">
                                                        <div>
                                                            <input type="checkbox" class="custom-checkbox" required>
                                                        </div>
                                                        <div class="ml-2">
                                                            <p>Tôi cam đoan truyện này không vi phạm <a href="{{route('regulation')}}" class="text-primary">Nội Quy</a></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary">Cập Nhật</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Hướng Dẫn</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="panel-body text-muted" style="word-wrap: break-word; white-space: normal;">
                                                        <p><strong>Không có ảnh bìa truyện?</strong></p>
                                                        <p>- Vào các trang này để tìm: <a class="text-primary" href="http://huaban.com" target="_blank" rel="nofollow">huaban.com</a>, <a class="text-primary" href="http://duitang.com" target="_blank" rel="nofollow">duitang.com</a></p>
                                                        <p>- Các từ khóa để tìm hình là: 小说 (tiểu thuyết), 小说封面 (bìa tiểu thuyết), 小说插图 (tranh minh họa tiểu thuyết), 小说插画 (tranh minh họa tiểu thuyết), 小说封面底图 (hình nền bìa tiểu thuyết), 言情 hoặc 言情小说 (ngôn tình), 玄幻小说 (huyền ảo), 都市小说 (hiện đại đô thị), 武侠小说 (võ hiệp), 仙侠小说 (tiên hiệp)</p>
                                                        <p>- Khi chọn được hình ưng ý, ấn vào biểu tượng kính lúp để tải hình chất lượng cao</p>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>

                <!-- /.row -->

            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection