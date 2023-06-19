<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('tim/assets/css/paper-dashboard.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link href="{{ asset('tim/assets/demo/demo.css') }}" rel="stylesheet" />
    @yield('css')

</head>

<style>
    hr {
        margin-top: 1px;
        margin-bottom: -30px;
        border: 1px;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .button {

        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 0 solid transparent;
        padding: 2.7px 0.75rem;
        font-size: 1rem;
        border-radius: 0.25rem;
    }
</style>

<body class="hold-transition sidebar-mini" style="background-color: #ededed; margin-right: 10px; margin-left: 10px;">
    <div class="wrapper mt-1">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ededed; color:black;">
            <a class="navbar-brand" href="{{ route('welcome.index') }}"><strong>Lubricentros C&D</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false" style="color:black;">
                            Administración
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Roles</a>
                            <a class="dropdown-item" href="#">Usuarios</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false" style="color:black;">
                            Gestión
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Cliente</a>
                            <a class="dropdown-item" href="#">Personal</a>
                            <a class="dropdown-item" href="#">Proveedor</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('products.index') }}">Almacén</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('sales.index') }}">Ventas</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('revisiones.index') }}">Revisión Técnica</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Caja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false" style="color:black;">
                            Reporte
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Ventas</a>
                        </div>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle user-profile" href="#" role="button"
                            data-toggle="dropdown" aria-expanded="false"><img
                                src="{{ asset($usuario->profilePicture) }}" alt=""
                                id="photo_navbar">{{ $usuario->username }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="{{ route('login.cerrarSesion') }}">Cerrar Sesion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <hr>
        <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('titulo')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>



            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('js')
</body>

</html>
