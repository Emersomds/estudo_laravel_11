@extends('layouts.admin');

@section('content')
    
    <h2> Detalhe do Curso</h2>

    <a href="{{route('courses.index') }}">Listar</a><br>
    <a href="{{route('courses.edit') }}">Editar</a> <br><br>

    {{-- dd($course) --}}
    ID: {{ $course->id }} <br>
    Nome: {{ $course->name }} <br>
    Cadastrado: {{ \Carbon\carbon::parse($course->created_at)->format('d/m/Y
        H:i:s') }} <br>
    Editado: {{ \Carbon\carbon::parse($course->updated_at )->format('d/m/Y
        H:i:s') }} <br><hr>

@endsection


