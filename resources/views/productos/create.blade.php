@extends('layouts.app_modal')

@section('header')
    Creando un producto
@endsection

@section('content')
    {!! Form::open(['route' => 'productos.store', 'id' => 'form']) !!}
        @include('productos.fields')
    {!! Form::close() !!}
@endsection