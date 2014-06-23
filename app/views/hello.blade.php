@extends('layout.base')

@section('content')

<h1>Bienvenido {{ Auth::user()->name; }}</h1>
<a href="{{url('/logout')}}">Cerrar sesión.</a>

@stop
    