@extends('layouts.admin')

@section('content')

    <H2>Listar os cursos</H2>
    
    
    <a href="{{route('courses.create') }}">Cadastrar</a> <br>
    <a href="{{route('courses.edit') }}">Editar</a> <br><br>

    

    @forelse ($courses as $course)
        {{ $course->id }}<br>
        {{ $course->name }}<br>
        {{ \Carbon\carbon::parse($course->created_at)->format('d/m/Y
        H:i:s') }}<br>
        {{ \Carbon\carbon::parse($course->updated_at )->format('d/m/Y
        H:i:s')}}<br>
        
        <a href="{{route('courses.show', ['course' => $course->id ]) }}">Visualizar</a> <br>
        <hr>

    @empty
        <p style="color: #f00">Nenhum curso encontrado!</p>
    @endforelse

    {{-- Imprimir a paginação --}}
    {{-- $courses->links() --}}

@endsection

    

