<?php

use Illuminate\Support\Facades\Session;

$ss_cus_name = Session::get('cus_name');

?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Truyện Convert</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/themify-icons/themify-icons.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/plugins/toastr/toastr.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="icon" href="{{asset('public/uploads/logo/logo.wepb')}}" type="image/gif" sizes="100x100">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/dist/css/adminlte.min.css')}}">
    <!-- cropper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{asset('public/assets/css/account_css.css')}}">

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/dist/js/adminlte.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
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

    <!-- AdminLTE App -->
    <script src="{{asset('public/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('public/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('public/dist/js/pages/dashboard2.js')}}"></script>
    <!-- cropper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"></script>
    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item" id="menu_btn">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('staff-guide')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('author-guide')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('faqs')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-white"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{URL::to('account/logout')}}" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-white-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('trangchu')}}" class="brand-link navbar-primary">
                <img src="{{asset('public/uploads/logo/logo.wepb')}}" alt="Truyện Convert Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Truyện Convert</span>
            </a>
            @if($ss_cus_name)
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-1 pb-3 pt-3 mb-1 d-flex">
                    <div class="image">
                        <?php
                        $cus_avatar = Session::get('cus_avatar');
                        $avata = "this.src='https://static.cdnno.com/user/88d3d6013bfa45cbc539fbeae5acc1c4/200.jpg?1642246239'";
                        ?>
                        <img onerror="{{$avata}}" src="{{asset('public/uploads/cus_avt/'.$cus_avatar)}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php
                            if ($ss_cus_name) {
                                echo Session::get('cus_name');
                            } else {
                                echo '';
                            } ?>
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        <li class="nav-item x">
                            <a href="{{route('profile')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-user mr-3"></i>
                                <p>
                                    Hồ Sơ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x ">
                            <a href="{{route('library')}}" class="nav-link  m-0 pt-3 pb-3">
                                <i class="nav-icon ti-bookmark mr-3"></i>
                                <p>
                                    Tủ Truyện
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('rewarded')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-gift mr-3"></i>
                                <p>
                                    Nhận Thưởng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('account_mail')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-email mr-3"></i>
                                @if(count($mail_notify)>0)
                                <span class="account_notify_icon"></span>
                                @endif
                                <p>
                                    Tin Nhắn
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('notification')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-bell mr-3"></i>
                                <p>
                                    Thông Báo
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('setting')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-settings mr-3"></i>
                                <p>
                                    Cài Đặt
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('pay')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-time mr-3"></i>
                                <p>
                                    Lịch Sử Thanh Toán
                                </p>
                            </a>
                        </li>
                        <li class="devider"></li>
                        <li class="nav-item x">
                            <a href="{{route('book.create')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-pencil-alt  mr-3"></i>
                                <p>
                                    Thêm Truyện Mới
                                </p>
                            </a>
                        </li>
                        <li class="nav-item x">
                            <a href="{{route('book.index')}}" class="nav-link m-0 pt-3 pb-3">
                                <i class="nav-icon ti-layers mr-3"></i>
                                <p>
                                    Truyện Đã Đăng
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
            @endif
        </aside>
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
                <div class="alert toast toast-error" aria-live="assertive">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="toast-message">{{ session('error') }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer text-center">
            <div><?php echo date('Y') ?> © truyencv.xyz</div>
        </footer>
        <!-- cropper -->
        <div class="modal fade bd-example-modal-lg imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-11">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg imagecrop2" id="model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-11">
                                    <img id="image2" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary crop" id="crop2">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tbl_account').DataTable();
        });
    </script>
    <script>
        CKEDITOR.replace('introduce');
    </script>
    <script>
        function cropper_2() {
            var $modal = $('.imagecrop');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", "#imageUpload_book", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 3 / 4,
                    viewMode: 1,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            $("body").on("click", "#crop", function() {
                canvas = cropper.getCroppedCanvas({
                    width: 600,
                    height: 800,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#base64image').val(base64data);
                        document.getElementById('imagePreview').style.backgroundImage = "url(" + base64data + ")";
                        $modal.modal('hide');
                    }
                });
            });
        }
        cropper_2()
    </script>
    <script>
        function cropper_1() {
            var $modal = $('.imagecrop2');
            var image = document.getElementById('image2');
            var cropper;
            $("body").on("change", "#imageUpload", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            $("body").on("click", "#crop2", function() {
                canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('#base64image').val(base64data);
                        document.getElementById('imagePreview').style.backgroundImage = "url(" + base64data + ")";
                        $modal.modal('hide');
                    }
                });
            });
        }

        cropper_1()
    </script>

    <!-- Toastr -->
    <script>
        $(document).ready(function() {
            $('.alert-form').fadeOut(7000)

        })
    </script>

    <script>
        $(document).on('click', '.slide .pagination a', function(event) {
            event.preventDefault()
            var page = $(this).attr('href').split('page=')[1]
            $.ajax({
                url: 'ajax?page=' + page
            }).done(function(data) {
                $('#xxxx').html(data);
                window.history.pushState("object or string", "Title", "?page=" + page);
            });
        })
    </script>
    <script>
        $(document).on('click', '.category .pagination a', function(event) {
            event.preventDefault()
            var page = $(this).attr('href').split('page=')[1]
            $.ajax({
                url: 'ajax_2?page=' + page
            }).done(function(data) {
                $('#yyyy').html(data);
                window.history.pushState("object or string", "Title", "?page=" + page);
            });
        })
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("name_slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script>
        $('#menu_btn').click(function() {
            $('body').toggleClass('sidebar-collapse')
        })
        $('#control-sidebar-form-x').click(function() {
            $('body').toggleClass('control-sidebar-slide-open')
        })
    </script>

</body>

</html>