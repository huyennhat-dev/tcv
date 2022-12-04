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
                        <li class="breadcrumb-item "><a href="{{route('account_mail')}}"> Tin Nhắn</a> </li>
                        <li class="breadcrumb-item active">Soạn Tin Nhắn</li>
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
                            <div class="card-header">
                                <h3 class="card-title text-primary">Gửi Thư Cho Admin Truyện Convert</h3>
                            </div>
                            <div class="card-body p-2">
                                <form method="POST" action="{{URL::to('/account/mail/'.$id)}}">
                                    @csrf
                                    <style>
                                        #cke_1_top {
                                            display: none !important;
                                        }

                                        #cke_1_contents {
                                            height: 360px !important;
                                        }
                                    </style>
                                    <div class="form-group">
                                        <label for="introduce" class="font-weight-normal">Nhập nội dung</label>
                                        <input type="hidden" name="send_id" value="{{$cus_id}}">
                                        <textarea id="introduce" name="noidung"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary ">Gửi</button>
                                    </div>
                                </form>
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