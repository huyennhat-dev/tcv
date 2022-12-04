@extends('../account')

@section('content')
<?php

use Illuminate\Support\Facades\Session;
// echo url()->previous();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('library')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tủ Truyện</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @csrf
    <?php
    $cus_name = Session::get('cus_name');
    $cus_avt = Session::get('cus_avatar');
    $cus_id = Session::get('cus_id');
    ?>
    <input type="hidden" name="u_id" id="u_id" value="{{$cus_id}}">
    <input type="hidden" name="u_name" id="u_name" value="{{$cus_name}}">
    <input type="hidden" name="u_img" id="u_img" value="{{$cus_avt}}">
    <!-- Main content -->
    <section class="content library">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title text-primary">Chát Chít Đa Vị Diện</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body show_chat"  style="display: block; min-height: 400px; max-height: 400px;" id="show_chat">
                            <!-- Conversations are loaded here -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="display: block;">
                            <form>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" id="chat_content" class="form-control">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary send_btn"><i class="far fa-paper-plane"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                    <div class="card  card-tabs">
                        @csrf
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-black" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                                        Đang Đọc
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                                        Đánh Dấu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <table class="table">
                                        <tbody id="dangdoc_tbl">
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <table class="table">
                                        <tbody id="danhdau_tbl">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                var _token = $('input[name="_token"]').val()
                                load_reading_account()
                                load_tickbook_account()

                                function load_reading_account() {
                                    $.ajax({
                                        url: "{{url('/load_reading_account')}}",
                                        method: "POST",
                                        data: {
                                            _token: _token
                                        },
                                        success: function(data) {
                                            $('#dangdoc_tbl').html(data)
                                        }
                                    })
                                }
                                $(document).on('click', '.del_reading_btn', function(e) {
                                    e.preventDefault()
                                    var id = $(this).data('idx')
                                    if (confirm('Bạn có muốn xóa truyện này?')) {
                                        $.ajax({
                                            url: "{{url('/del_reading')}}",
                                            method: "POST",
                                            data: {
                                                id: id,
                                                _token: _token
                                            },
                                            success: function(data) {
                                                load_reading_account()
                                            }
                                        })
                                    }
                                })

                                function load_tickbook_account() {
                                    $.ajax({
                                        url: "{{url('/load_tickbook_account')}}",
                                        method: "POST",
                                        data: {
                                            _token: _token
                                        },
                                        success: function(data) {
                                            $('#danhdau_tbl').html(data)
                                        }
                                    })
                                }
                                $(document).on('click', '.del_tickbook_btn', function(e) {
                                    e.preventDefault()
                                    var id = $(this).data('idy')
                                    if (confirm('Bạn có muốn xóa truyện này?')) {
                                        $.ajax({
                                            url: "{{url('/del_tickbook_account')}}",
                                            method: "POST",
                                            data: {
                                                id: id,
                                                _token: _token
                                            },
                                            success: function(data) {
                                                load_tickbook_account()
                                            }
                                        })
                                    }
                                })
                            })
                        </script>
                        <!-- /.card -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <script>
                    $(document).ready(function() {


                        var _token = $('input[name="_token"]').val()
                        var u_id = $('#u_id').val()
                        var u_name = $('#u_name').val()
                        var u_avt = $('#u_img').val()
                        load_chat_account_2()

                        function load_chat_account_2() {

                            $.ajax({
                                url: "{{url('/load_chat_account')}}",
                                method: "POST",
                                data: {
                                    _token: _token
                                },
                                success: function(data) {
                                    $('#show_chat').html(data)

                                    $("#show_chat").scrollTop($("#show_chat")[0].scrollHeight);

                                }
                            })
                        }

                        setInterval(
                            function load_chat_account() {

                                $.ajax({
                                    url: "{{url('/load_chat_account')}}",
                                    method: "POST",
                                    data: {
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#show_chat').html(data)
                                    }
                                })
                            }, 1000)
                        $(document).on('click', '.send_btn', function(e) {
                            e.preventDefault()
                            const chat_content = $('#chat_content').val()
                            <?php
                            if (isset($cus_id)) {
                            ?>
                                $.ajax({
                                    url: "{{url('/send_chat')}}",
                                    method: "POST",
                                    data: {
                                        u_id: u_id,
                                        chat_content: chat_content,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#chat_content').val(' ')
                                        load_chat_account_2()
                                    }
                                })
                            <?php } else { ?>
                                window.location = "{{URL::to('account/login')}}"
                            <?php } ?>
                        })


                    })
                </script>
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection