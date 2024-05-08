@extends('layouts.admin')

@section('content')

    <H2>Listar os cursos</H2>
    
    
    <a href="{{route('courses.create') }}">
        <button type="button">Cadastrar</button>
    </a> <br>
    
     @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    

    @forelse ($courses as $course)
        ID: {{ $course->id }}<br>
        Nome: {{ $course->name }}<br>
        Preço: {{ 'R$ ' . number_format($course->price, 2, ',', '.')}}<br>
        Cadastrado: {{ \Carbon\carbon::parse($course->created_at)->format('d/m/Y
        H:i:s') }}<br>
        Editado: {{ \Carbon\carbon::parse($course->updated_at )->format('d/m/Y
        H:i:s')}}<br><br>
        
        <a href="{{route('courses.show', ['course' => $course->id ]) }}">
            <button type="button">Visualizar</button>
        </a> <br>

        <a href="{{route('courses.edit', ['course' => $course->id ]) }}">
            <button type="button">Editar</button>
        </a><br>

        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Tem certeza que deseja Deletar este registro?')">Apagar</button>
        </form>

        <hr>

    @empty
        <p style="color: #f00">Nenhum curso encontrado!</p>
    @endforelse

    {{-- Imprimir a paginação --}}
    {{-- $courses->links() --}}

@endsection

    

