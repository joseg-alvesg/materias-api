@extends('layouts.main')

@section('title', 'Materias')

@section('content')
<div class="d-flex flex-wrap gap-4 mt-3 text-sm w-75 justify-content-center">
    @foreach($materias as $materia)
    <div class="w-25">
        <div class="card h-100">
            <img src="/images/{{ $materia->imagem }}" alt="{{ $materia->titulo }}" class="card-img-top" style="object-fit: cover; height: 200px;">
            <div class="card-body d-flex flex-column">
                <h2 class="card-title">{{ $materia->titulo }}</h2>
                <h3 class="card-text">{{ $materia->descricao }}</h3>
                <p class="card-text">{{ $materia->data_de_publicacao }}</p>
                <a href="/materias/{{ $materia->id }}" class="btn btn-primary mt-auto">Ler mais</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
