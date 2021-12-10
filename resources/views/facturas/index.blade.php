@extends('layouts.app')

@section('title')
    Facturas
    <a class="btn-primary btn float-right" onclick="crearFactura()">Nuevo</a>
@endsection

@section('content')
    @include('facturas.table')
@endsection

@push('scripts')
    <script type="text/javascript">
        crearFactura = () => {
            cargarModal('{{ route('facturas.create') }}', 'lg')
        }
    </script>
@endpush