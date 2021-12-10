<!doctype html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}" />
        <style>
            a {
                cursor: pointer;
            }

            .bordered {
                border: 1px solid #ccc !important;
            }
        </style>
        @stack('css')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('productos*')) active @endif" href="{{ route('productos.index') }}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('facturas*')) active @endif" href="{{ route('facturas.index') }}">Facturas</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link @if(Route::is('login')) active @endif" href="{{ route('login') }}">Ingreso</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(Route::is('register')) active @endif" href="{{ route('register') }}">Registro</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ $sesion->nombre }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
                                            Salir
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        @yield('title')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    @yield('content')
                                    <div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="ventanaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document" id="ventana-size">
                                            <div class="modal-content" id="ventana-content"><div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.blockUI.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/sweetalert2@9.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/maskMoney.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/ajax-form.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/font-awesome.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript">
            const FORMATTER = new Intl.NumberFormat()
            $(document).ready(function () {
                $('#ventana').on('hidden.bs.modal', function (e) {
                    e.target.id == 'ventana' && $('#ventana-content').empty()
                })
            })

            mostrarErroresAjax = (res) => {
                var html = ''
                $.each(res.responseJSON.errors, function (campo, valor) {
                    $.each(valor, function (campo, val) {
                        html += val + '<br>';
                    })
                })
                $('#errores>#mensajes').html(html)
                $('#errores').removeClass('d-none')
                window.location.href = '#errores'
            }

            cargarModal = (url, size) => {
                $.blockUI()
                $('#ventana-content').load(url, function (response, status, request) {
                    $.unblockUI()
                    status == 'success'
                        ? (
                            $('#ventana').modal('show'),
                            $('#ventana-size').removeClass('modal-sm').removeClass('modal-md').removeClass('modal-lg').removeClass('modal-xl').addClass(`modal-${size}`)
                        ) : Swal.fire('Ha ocurrido un error', response.responseText, 'error')
                })
            }

            cerrarModal = () => {
                $('#ventana').modal('hide')
            }

            soloNumeros = (valor) => {
                var out = '',
                    filtro = '0123456789'
                for (var i=0; i < valor.length; i++)
                    if (filtro.indexOf(valor.charAt(i)) != -1)
                        out += valor.charAt(i)
                return out
            }

            confirmarEliminacion = async (form, ajax, callback) => {
                await ajaxForm(form, callback)
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: '¡Sí, eliminar!'
                }).then((result) => {
                    if (result.value) {
                        $.blockUI()
                        $(form).submit()
                    }
                })
            }

            ajaxForm = (form, callback) => {
                $(form).ajaxForm({
                    success: function (r) {
                        $.unblockUI()
                        Swal.fire('Hecho', r, 'success').then(callback)
                    },
                    error: function (r) {
                        $.unblockUI()
                        Swal.fire('Ha ocurrido un error', r.responseText, 'error')
                    }
                })
            }
        </script>
        @stack('scripts')
    </body>
</html>
