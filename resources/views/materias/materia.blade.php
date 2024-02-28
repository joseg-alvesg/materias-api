@extends('layouts.main')

@section('title', 'Materia')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="display-4 text-center mb-4">{{ $materia->titulo }}</h1>
            <h2 class="text-body-tertiary">{{ $materia->descricao }}</h2>
            <img src="/images/{{ $materia->imagem }}" alt="{{ $materia->titulo }}" class="img-fluid mb-3">
            <p>{{ $materia->texto_completo }}</p>
            <p>Publicado em: {{ $materia->data_de_publicacao }}</p>
            <p>
                <a href="/materias/edit/{{ $materia->id }}" class="btn btn-primary">Editar</a>
                <a href="/materias/delete/{{ $materia->id }}" class="btn btn-danger">Excluir</a>
            </p>
        </div>
    </div>
</div>
@endsection
