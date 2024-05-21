@extends('layouts.admin')

@section('content')

    <h2>Editar Aula</h2>

    <a href="{{ route('classe.index', ['course' => $classe->course_id]) }}">
        <button type="button">Aulas</button>
    </a><br><br>

    <x-alert />

    <form action="{{ route('classe.update', ['classe' => $classe->id ]) }}" method="POST">
    @csrf
    @method('PUT')

        
        <label>Curso: </label>
        <input type="text" name="name_cuorse" id="name_course"  value="{{ $classe->course->name }}" disabled ><br><br>
        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name', $classe->name) }}" required ><br><br>

        <label>Descrição</label>
        <textarea name="description" id="description" rows="4" cols="30" required>{{ old('description', $classe->description)}}</textarea><br><br>

        <button type="submit">Editar</button>

    </form>
@endsection