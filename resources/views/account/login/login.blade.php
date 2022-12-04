@extends('../form')

@section('content')
<div class="login-box w-100">
    <!-- /.login-logo -->
    <div class="text-center w-100 mt-5">
        <img style="width: 150px;" src="{{asset('public/uploads/logo/logo.wepb')}}" alt="">
    </div>
    <div class="px-5">
        <p><i>Nếu chưa có tài khoản, vui lòng đăng ký tài khoản mới</i></p>
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

    </div>
    <div class="">
        <div class="card-body">
            <form action="login" method="POST" id="quickForm">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="fw-500" for="exampleInputEmail1">Email </label>
                        <input autocomplete="off" type="email" name="email" class="form-control form-control-border" value="{{old('name')}}" id="exampleInputEmail1" placeholder="Địa chỉ email">
                    </div>
                    <div class="form-group">
                        <label class="fw-500" for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" name="password" class="form-control form-control-border" value="{{old('password')}}" id="exampleInputPassword1" placeholder="Mật khẩu">
                    </div>
                    <label class="fw-500">Captcha</label>
                    <div class="form-group position-relative">
                        <div class="d-flex">
                            <label class="capt position-absolute" id="lb-capt" for="capt" onclick="cap()">
                                <i class="nav-icon fas fa-sync-alt "></i>
                            </label>
                            <input type="text" class="form-control form-control-border no-copy-paste" for="" id="capt" name="capt" readonly>
                            <input type="text" class="form-control form-control-border ml-2 no-copy-paste" name="captcha" id="textcaptcha" placeholder="Captcha" />
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <div>
        <div class="px-5">
            <p>
                Bạn chưa có tài khoản?
                <a href="{{URL::to('account/register')}}">Đăng ký</a>
            </p>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection