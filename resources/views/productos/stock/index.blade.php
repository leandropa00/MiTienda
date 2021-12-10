@extends('layouts.app_modal')

@section('header')
    Stock - {{ $producto->nombre }}
@endsection

@section('content')
    <a onclick="crearStock()" class="btn btn-primary text-white float-right mb-1">
        Nuevo
    </a>
    <br><br>
    <div id="stock-form" class="mb-3"></div>
    @include('productos.stock.table')
    <script type="text/javascript">
        crearStock = () => {
            $.blockUI()
            $('#stock-form').load(
                '{{ route('stock.create', $producto->id) }}', 
                (response, status, request) => {
                    status == 'error' && Swal.fire('Ocurrió un error', response, 'error')
                    $.unblockUI()
                }
            )
        }
    </script>
@endsection
