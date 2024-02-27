@extends('layouts.main')

@section('title', 'Materias')

@section('content')
    <h1>Blog</h1>

<div>
    <img src="/images/{{ $materia->imagem }}" alt="{{ $materia->titulo }}" width="100">
    <h2>{{ $materia->titulo }}</h2>
    <p>{{ $materia->descricao }}</p>
    <p>{{ $materia->conteudo }}</p>
    <p>{{ $materia->texto_completo }}</p>
</div>
@endsection
