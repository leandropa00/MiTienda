@extends('layouts.app')

@section('title')
    Productos
    <a class="btn-primary btn float-right" onclick="crearProducto()">Nuevo</a>
@endsection

@section('content')
    @include('productos.table')
@endsection

@push('scripts')
    <script type="text/javascript">
        crearProducto = () => {
            cargarModal('{{ route('productos.create') }}', 'lg')
        }

        editarProducto = (id) => {
            cargarModal('{{ route('productos.edit', ':id') }}'.replace(':id', id), 'lg')
        }
    </script>
@endpush