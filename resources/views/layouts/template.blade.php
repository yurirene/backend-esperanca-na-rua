<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard da Plataforma Esperança na Rua">
    <meta name="author" content="Yuri Ferreira">
    <link rel="icon" type="image/png" sizes="16x16" href="/sitev2/assets/images/favicon.png">
    <title>Esperança na Rua - @yield('header', 'Dashboard')</title>
    <link href="/sitev2/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="/sitev2/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/sitev2/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="/sitev2/dist/css/style.min.css" rel="stylesheet">
    <link href="/sitev2/dist/css/custom.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    {{-- MAPA --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>
     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/toastr/toastr.min.css" rel="stylesheet" />
    <link href="/cuteAlert/style.css" rel="stylesheet" />
    <style>
        #map { height: 600px; }
        .paginate_button.page-item.previous a,
        .paginate_button.page-item.next a {
            width: 100px;
            margin-right: 20px;
            margin-left: 20px;
            border-radius: 10px !important;
        }
    </style>

    @livewireStyles
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md" aria-label="menu">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <em class="ti-menu ti-close"></em>
                    </a>

                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="{{ route('dashboard.index') }}">
                            <span class="logo-text">
                                <img src="/sitev2/assets/images/logo-dj.png"
                                alt="homepage" style="height:50px;" class="dark-logo" />
                            </span>
                        </a>
                    </div>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <em class="ti-more"></em>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="/sitev2/assets/images/profile-img.jpg" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span class="text-dark">{{ auth()->user()->name }}</span>
                                    <em data-feather="chevron-down" class="svg-icon"></em>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <em data-feather="user" class="svg-icon mr-2 ml-1"></em>
                                    Minha Conta
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <em data-feather="power" class="svg-icon mr-2 ml-1"></em>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                @include('layouts.menu')
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                            Olá, {{ auth()->user()->name }}!
                        </h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">@yield('cabecalho', 'Dashboard')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                @yield('conteudo')

            </div>

            <footer class="footer text-center text-muted">
                Copyright ©
                <script>
                    document.write(new Date().getFullYear())
                </script> Esperança na Rua.
            </footer>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="/toastr/toastr.min.js"></script>
    <script src="/cuteAlert/cute-alert.js"></script>
    <script src="/sitev2/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/sitev2/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/sitev2/dist/js/app-style-switcher.js"></script>
    <script src="/sitev2/dist/js/feather.min.js"></script>
    <script src="/sitev2/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/sitev2/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/sitev2/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="/sitev2/assets/extra-libs/c3/d3.min.js"></script>
    <script src="/sitev2/assets/extra-libs/c3/c3.min.js"></script>
    <script src="/sitev2/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="/sitev2/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="/sitev2/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/sitev2/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.2/b-2.0.0/b-html5-2.0.0/b-print-2.0.0/datatables.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    <!-- SCRIPT PARA DROPDOWN EM TABELAS -->
    <script>
        $('.table-responsive').on('show.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "inherit" );
        });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        var EventoSweetAlert = function(){
            this.dispatcher = $({});
        };
        EventoSweetAlert.prototype = {
            some_property: null,
            finalizado: function(msg = '') {
                this.some_property = msg;
                this.dispatcher.trigger("sweetAlertFinalizado");
            }
        };
        const EVENTO_SWEET_ALERT = new EventoSweetAlert();

        function confirmacao(route, data, type = 'GET') {
            Swal.fire({
                title: 'Confirma Operação?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route,
                        data: data,
                        type: type
                    })
                    .done(function() {
                        Swal.fire('Concluído!', '', 'success')
                        EVENTO_SWEET_ALERT.finalizado();
                    })
                    .fail(function() {
                        Swal.fire('Erro Inesperado!', '', 'error')
                    })
                }
            })
        }
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @include('layouts.toastr')
    @include('layouts.cuteAlert')

    @stack('js')
    @livewireScripts
</body>

</html>
