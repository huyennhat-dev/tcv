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
                        <li class="breadcrumb-item active">Quy Định Khi Đăng Truyện</li>
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
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="white-box py-3 px-2">
                            <h2 class="text-center m-b-20"><strong>Quy Định Khi Đăng Truyện</strong></h2>
                            <ol>
                                <li class="fz-15 lh-15x">Không được phép đăng các truyện liên quan tới chính trị, tôn giáo, tình dục, sắc hiệp, dâm hiệp, nói xấu Việt Nam.</li>
                                <li class="fz-15 lh-15x">Chỉ được đăng các truyện do bạn tự sáng tác hoặc bạn có quyền sử dụng.</li>
                                <li class="fz-15 lh-15x">Tên truyện phải viết hoa chữ đầu mỗi từ: <span style="font-weight: bold;">Giống Như Thế Này</span>.</li>
                                <li class="fz-15 lh-15x">Nội dung giới thiệu truyện và nội dung chương truyện trình bày phải phân đoạn rõ ràng, nếu viết thành 1 khối dày đặc chữ sẽ bị xóa.</li>
                                <li class="fz-15 lh-15x">Không được quảng cáo các trang web, nền tảng, dịch vụ khác <span style="font-weight: bold;">dưới mọi hình thức</span>.</li>
                                <li class="fz-15 lh-15x">Không được đưa thông tin donate/ủng hộ của các trang web, nền tảng, dịch vụ khác <span style="font-weight: bold;">dưới mọi hình thức</span>.</li>
                                <li class="fz-15 lh-15x">Ảnh bìa truyện không có các hình ảnh khiêu dâm, kích dục, kích động, thù hằn, ám chỉ đến tôn giáo, chính trị, các hoạt động bị cấm bởi pháp luật.</li>
                                <li class="fz-15 lh-15x">Tất cả truyện bạn đăng lên hệ thống có bản quyền thuộc về cá nhân của bạn. Khi đăng truyện lên hệ thống bạn cho phép các website thuộc hệ thống quyền khai thác quảng cáo và quyền thu hộ trả phí (mở khóa) các chương truyện trên các truyện bạn đã đăng.&nbsp;</li>
                                <li class="fz-15 lh-15x">Quy định có thể thay đổi mà không cần báo trước</li>
                            </ol>
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