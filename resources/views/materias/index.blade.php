@extends('layouts.main')

@section('title', 'Materias')

@section('content')
    <h1>Blog</h1>

<div>

    @foreach($materias as $materia)
    <img src="/images/{{ $materia->imagem }}" alt="{{ $materia->titulo }}" width="100">
    <h2>{{ $materia->titulo }}</h2>
    <p>{{ $materia->descricao }}</p>
    @endforeach
</div>
@endsection
