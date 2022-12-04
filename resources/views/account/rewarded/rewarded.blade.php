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
                        <li class="breadcrumb-item active">Nhận Thưởng</li>
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
                    <div class="card  card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-black" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                                        Nhiệm Vụ Hàng Ngày
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                                        Nhiệm Vụ Đơn
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="alert alert-primary">
                                        Nhiệm vụ hàng ngày sẽ tự động làm mới vào 00:00 (GMT +7) hàng ngày. Đừng quên <strong>Nhận Thưởng</strong> các nhiệm vụ đã làm xong trước khi qua ngày mới. Một số nhiệm vụ chỉ có thể <strong>Nhận Thưởng</strong> trên APP
                                    </div>
                                    <div>
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Thêm 1 bình luận</strong>
                                                        <p class="text-muted"><small> 3 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/31" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Đề cử Hoa cho một truyện</strong>
                                                        <p class="text-muted"><small>300 Kẹo </small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/18" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Đọc 5 chương của một truyện chưa từng đọc</strong>
                                                        <p class="text-muted"><small> 10 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/28" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Check-in</strong>
                                                        <p class="text-muted"><small>500 Kẹo </small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/15" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Đổi mã thẻ</strong>
                                                        <p class="text-muted"><small> 20 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/29" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Tặng quà cho tác giả hoặc dịch giả</strong>
                                                        <p class="text-muted"><small> 15 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/10" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;daily-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Xem video quảng cáo</strong>
                                                        <p class="text-muted"><small>Kẹo ngẫu nhiên</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <a class="btn btn-danger btn-block btn-rounded" href="//app.truyen.onl" target="_blank">Tải App</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <div class="alert alert-primary">
                                        Các nhiệm vụ đơn chỉ có thể <strong>Nhận Thưởng</strong> một lần. Một số nhiệm vụ chỉ có thể <strong>Nhận Thưởng</strong> trên APP
                                    </div>
                                    <div>
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            Đánh dấu một truyện
                                                        </strong>
                                                        <p class="text-muted"><small>1000 Kẹo + 5 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <button class="btn btn-warning btn-block btn-rounded disabled" disabled="">
                                                            <i class="ti-check"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            Đọc 10 chương truyện
                                                        </strong>
                                                        <p class="text-muted"><small> 20 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <button class="btn btn-warning btn-block btn-rounded disabled" disabled="">
                                                            <i class="ti-check"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            Cập nhật đầy đủ thông tin cá nhân
                                                        </strong>
                                                        <p class="text-muted"><small>5000 Kẹo + 5 Exp</small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/6" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;single-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            Đã có 03 bình luận có nội dung chất lượng từ
                                                            01/10 -&gt; 16/10
                                                        </strong>
                                                        <p class="text-muted"><small>10000 Kẹo </small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/39" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;single-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>
                                                            Đã có 01 đánh giá có nội dung chất lượng từ
                                                            06/10 -&gt; 16/10
                                                        </strong>
                                                        <p class="text-muted"><small>10000 Kẹo </small></p>
                                                    </td>
                                                    <td width="140">
                                                        <form action="https://pub.truyen.onl/account/reward/40" method="post">
                                                            <input type="hidden" name="_token" value="lO9Ee0JYJF23Rmz2W6LDN20f5BCIVBiTWiIWLv8X"> <input type="hidden" name="_method" value="patch"> <input type="hidden" name="queryStr" value="{&quot;tab&quot;:&quot;single-tab&quot;}">
                                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">Nhận thưởng</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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