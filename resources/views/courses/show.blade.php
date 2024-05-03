@extends('layouts.admin');

@section('content')
    
    <h2> Detalhe do Curso</h2>

    <a href="{{route('courses.index') }}">Listar</a><br>
    <a href="{{route('courses.edit') }}">Editar</a> <br>

@endsection


