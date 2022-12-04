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
    <link rel="icon" href="{{asset('public/uploads/logo/logo.wepb')}}" type="image/gif" sizes="100x100">
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

        .bg-login {
            background-size: cover !important;
            background: no-repeat;

        }

        .login-form {
            background: #fff;
            max-height: 100vh;
            overflow-y: scroll;
            scrollbar-width: none;
        }

        .login-form::-webkit-scrollbar {
            display: none;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .col-0 {
            display: none;
        }

        .wrapper,
        body,
        html {
            min-height: 100% !important;
        }
    </style>
</head>

<body>
    <div>
        <section class="content">
            <div class="container-fluid  bg-login" style="background-image: url('../public/bg/IMG_xinh.jpg')">
                <div class="row" style="height: 100vh;">
                    <div class="col-lg-9 col-md-7 col-sm col"></div>
                    <div class="col-lg-3 col-md-5 col-sm-12 col-12 login-form px-2" style="height: 100vh;">
                        @yield('content')
                    </div>
                </div>
        </section>
    </div>
    <!-- /.login-box -->
    <!-- jQuery Mapael -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script script src="{{asset('public/plugins/jquery/jquery.min.js')}}">
    </script>
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
                    re_password: {
                        required: true,
                        minlength: 8
                    },
                    terms: {
                        required: true
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
                    re_password: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu của bạn phải dài ít nhất 8 ký tự"
                    },
                    terms: "Vui lòng chấp nhận các điều khoản của chúng tôi",
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
            $('.alert-form').fadeOut(10000)
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
    <script>
        $(document).ready(function() {
            var ctrlDown = false,
                ctrlKey = 17,
                cmdKey = 91,
                vKey = 86,
                cKey = 67;

            $(document).keydown(function(e) {
                if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
            }).keyup(function(e) {
                if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
            });

            $(".no-copy-paste").keydown(function(e) {
                if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
            });

            // Document Ctrl + C/V 
            $(document).keydown(function(e) {
                if (ctrlDown && (e.keyCode == cKey)) console.log("Document catch Ctrl+C");
                if (ctrlDown && (e.keyCode == vKey)) console.log("Document catch Ctrl+V");
            });
        });
    </script>
</body>

</html>