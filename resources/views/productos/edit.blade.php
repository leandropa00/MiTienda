@extends('layouts.app_modal')

@section('header')
    Editando un producto
@endsection

@section('content')
    {!! Form::model($producto, ['route' => ['productos.update', $producto->id], 'id' => 'form', 'method' => 'patch']) !!}
        @include('productos.fields')
    {!! Form::close() !!}
@endsection