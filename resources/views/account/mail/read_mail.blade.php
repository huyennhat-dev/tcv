@extends('../account')

@section('content')
<?php

use Illuminate\Support\Facades\Session;

$cus_id = Session::get('cus_id');

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('library')}}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{route('account_mail')}}">Tin Nhắn</a></li>
                        <li class="breadcrumb-item active">Thư Từ Admin Truyện Convert</li>
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
                <div class="col-12" id="accordion">
                    <div class="white-box p-3">
                        <div class="card mb-0">
                            <div class="card-header ">
                                <h3 class="card-title text-primary d-flex align-items-center">
                                    <img class="mr-2" width="35" src="{{asset('public/uploads/logo/logo.png')}}" alt="">
                                    Thư Từ Admin Truyện Convert
                                </h3>
                            </div>
                            <div class="card-body p-2">
                                <div class="form-group read_mail px-5 py-4">
                                    <?= $mail->noidung ?>
                                </div>
                                <div class="form-group text-center">
                                    <a href="{{URL::to('/account/mail/0')}}" class="btn btn-primary">Trả lời</a>
                                </div>

                            </div>
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