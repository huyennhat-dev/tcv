<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/themify-icons/themify-icons.css')}}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/plugins/toastr/toastr.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">
    <style>
        #lb-capt {
            top: 7px;
            left: 5px;
            cursor: pointer;
        }

        #lb-capt i {
            font-size: 18px;

        }

        #capt {
            width: 120px;
            background: #fff;
            padding-left: 30px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1">Admin Truyện CV</a>
            </div>
            <div class="card-body">
                @if (session('login_fail'))
                <div class=" alert-form">
                    <div id="toast-container" class="toast-top-right">
                        <div class="alert toast toast-warning" aria-live="assertive">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <div class="toast-message">{{ session('login_fail') }}</div>
                        </div>
                    </div>
                </div>
                @endif
                <form action="{{URL::to('admin/home')}}" method="POST" id="quickForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input autocomplete="off" type="email" name="email" class="form-control" value="{{old('name')}}" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" value="{{old('password')}}" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <label>Captcha</label>
                        <div class="form-group position-relative">
                            <div class="d-flex">
                                <label class="capt position-absolute" id="lb-capt" for="capt" onclick="cap()">
                                    <i class="nav-icon fas fa-sync-alt "></i>
                                </label>
                                <input type="text" class="form-control" for="" id="capt" name="capt" readonly>
                                <input type="text" class="form-control ml-2" name="captcha" id="textcaptcha" placeholder="Catcha" />
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
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery Mapael -->
    <!-- jQuery -->
    <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('public/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('public/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('public/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{asset('public/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('public/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('public/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('public/plugins/toastr/toastr.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('public/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('public/dist/js/pages/dashboard2.js')}}"></script>
    <!-- cropper -->
    <script>
        $(function() {

            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    captcha: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Vui lòng nhập địa chỉ email",
                        email: "Vui lòng nhập địa chỉ email "
                    },
                    password: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu của bạn phải dài ít nhất 8 ký tự"
                    },
                    captcha: {
                        required: "Vui lòng nhập captcha"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.alert-form').fadeOut(7000)
        })
    </script>
    <script type="text/javascript">
        function cap() {
            var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
                'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#', '$', '%', '^', '&', '*', '+'
            ];
            var a = alpha[Math.floor(Math.random() * 71)];
            var b = alpha[Math.floor(Math.random() * 71)];
            var c = alpha[Math.floor(Math.random() * 71)];
            var d = alpha[Math.floor(Math.random() * 71)];
            var e = alpha[Math.floor(Math.random() * 71)];
            var f = alpha[Math.floor(Math.random() * 71)];

            var final = a + b + c + d + e + f;
            document.getElementById("capt").value = final;
        }

        function validcap() {
            var stg1 = document.getElementById('capt').value;
            var stg2 = document.getElementById('textcaptcha').value;
            if (stg1 == stg2) {
                alert("Form is validated Succesfully");
                return true;
            } else {
                alert("Please enter a valid captcha");
                return false;
            }
        }
        cap();
    </script>
</body>

</html>