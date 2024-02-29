@extends('layouts.main')

@section('title', 'Materias')

@section('content')
<div class="row row-cols-2 row-cols-md-4 g-4 mt-3">
    @foreach($materias as $materia)
    <div class="col">
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
