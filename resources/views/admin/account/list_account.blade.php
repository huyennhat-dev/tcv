@extends('../layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách khách hàng</li>
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
            <div class="row justify-content-center">
                <div class="col-12 col-sm-11 col-md-11">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách khách hàng</h3>
                        </div>
                        <!--  -->
                        @if ($errors->any())
                        <div class=" alert-form">
                            <div id="toast-container" class="toast-top-right">
                                <div class="alert toast toast-error" aria-live="assertive">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="toast-message">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('msg'))
                        <div class=" alert-form">
                            <div id="toast-container" class="toast-top-right">
                                <div class="alert toast toast-success" aria-live="polite">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="toast-message"> {{ session('msg') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class=" alert-form">
                            <div id="toast-container" class="toast-top-right">
                                <div class="alert toast toast-warning" aria-live="assertive">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <div class="toast-message">{{ session('error') }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div id="alert"></div>
                        <div class="card mb-0" id="">
                            <div class="card-body">
                                @csrf
                                <table class="table table-responsive table-hover" id="tbl_admin">
                                    <thead>
                                        <tr>
                                            <th class="w-30 fw-500 text-center">STT</th>
                                            <th class="w-150 ">Hình Ảnh</th>
                                            <th class="w-250 fw-500">Tên Khách Hàng</th>
                                            <th class="w-200 fw-500">Số Truyện</th>
                                            <th class="w-200 fw-500">Số Chương</th>
                                            <th class="w-200 fw-500">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($account as $key => $val )
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>
                                                <a href="{{URL::to('/admin/account/'.$val->id)}}">
                                                <?php $avata = "this.src='https://static.cdnno.com/user/88d3d6013bfa45cbc539fbeae5acc1c4/200.jpg?1642246239'"; ?>
                                                <img onerror="{{$avata}}" width="40" src="{{asset('public/uploads/cus_avt/'.$val->avatar)}}" alt="">
                                                </a>
                                            </td>
                                            <td><a href="{{URL::to('/admin/account/'.$val->id)}}" class="text-primary">{{$val->username}}</a></td>
                                            <td>{{$count_book[$key]}}</td>
                                            <td>
                                                @if($count_book[$key]>0)
                                                {{array_sum($count_chap[$key])}}
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{URL::to('/admin/account/'.$val->id)}}" class="btn btn-success btn-xs mr-2">Chi Tiết</a>
                                                    <a href="{{URL::to('/admin/mailbox/'.$val->id)}}" class="btn btn-primary btn-xs ">Nhắn Tin</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- <div class="w-100  text-center mt-3">
                                </div> -->
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