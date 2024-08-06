<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{--    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">@yield('navbar-title')
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user" style="padding-right: 4px"></i>{{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item" id="resetPasswordBtn">
                        Şifrəni dəyiş
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <form action="{{route('logout.user')}}" method="post">
                            @csrf
                            <button class="btn btn-primary-outline text-black p-0" type="submit">Hesabdan çıx
                            </button>
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">FMS Admin</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('home')}}"
                           class="nav-link
                           {{
                            Route::is('home')
                            || Route::is('companies.index')
                            || Route::is('companies.projects.index')
                            || Route::is('companies.projects.folders.index')
                            || Route::is('companies.projects.folders.documents.index')
                            || Route::is('companies.projects.folders.documents.contracts.create')
                            || Route::is('companies.projects.folders.documents.contracts.edit')
                            || Route::is('companies.projects.folders.documents.contract-additions.create')
                            || Route::is('companies.projects.folders.documents.contract-additions.edit')
                            || Route::is('companies.projects.folders.documents.protocols.create')
                            || Route::is('companies.projects.folders.documents.protocols.edit')
                            || Route::is('companies.projects.folders.documents.delivery-statements.create')
                            || Route::is('companies.projects.folders.documents.delivery-statements.edit')
                             ? 'active' : ''
                             }}"><i class="fa-solid fa-grip"></i>
                            <p>Əsas səhifə</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.index')}}"
                           class="nav-link {{Route::is('users.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-users fa-sm"></i>
                            <p>İstifadəçilər</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tags.index')}}"
                           class="nav-link {{Route::is('tags.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-tags fa-sm"></i>
                            <p>Açar sözlər</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            @yield('content-header')
        </div>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script src="{{asset('dist/js/adminlte.js?v=3.2.0')}}"></script>
<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type'),'info'}}"
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;

        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;

        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;

        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif

    $('#resetPasswordBtn').on('click', function (e) {
        e.preventDefault();
        $('#resetPasswordModal').modal('show');
    })

    $('#resetPasswordForm').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.showPassword', function (e) {
        e.preventDefault();

        if ($('#new_password').prop('type') != 'password') {
            $('#showPasswordIcon').removeClass('fa-eye');
            $('#showPasswordIcon').addClass('fa-eye-slash');
            $("#new_password").prop("type", "password");
        }else{
            $('#showPasswordIcon').addClass('fa-eye');
            $('#showPasswordIcon').removeClass('fa-eye-slash');
            $("#new_password").prop("type", "text");
        }
    })

    $(document).on('click', '.savePasswordBtn', function (e) {
        e.preventDefault();
        console.log(123)
        let formData = new FormData(document.getElementById('resetPasswordForm'));
        $.ajax({
            type: 'POST',
            url: '/user/reset-password',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#resetPasswordModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#resetPasswordForm").trigger('reset');

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#newPasswordError').html(error.responseJSON.errors.new_password);
            }
        })
    })

</script>
@include('users.reset_password_modal')
</body>
</html>
