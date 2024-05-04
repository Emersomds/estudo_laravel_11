@extends('layouts.admin')

@section('content')

    <H2>Listar os cursos</H2>
    
    <a href="{{route('courses.show') }}">Visualizar</a> <br>
    <a href="{{route('courses.create') }}">Cadastrar</a> <br>
    <a href="{{route('courses.edit') }}">Editar</a> <br>

@endsection

    

