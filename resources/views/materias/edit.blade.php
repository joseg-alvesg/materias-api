@extends('layouts.main')

@section('title', 'Editar Matéria')

@section('content')
@csrf
<div class="container mt-2 fs-3" style="height: 100vh;">
    <h1 class="mt-3">Editar Matéria</h1>
    <hr class="w-50">
    <form action="/materias/update" method="post" enctype="multipart/form-data" class="w-50 mt-5">
        @csrf
        <input type="hidden" name="id" value="{{ $materia->id }}">
        <div class="form-group mb-3">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $materia->titulo }}">
        </div>
        <div class="form-group mb-3">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $materia->descricao }}">
        </div>
        <div class="form-group mb-3">
            <label for="texto_completo">Texto Completo:</label>
            <textarea class="form-control" id="texto_completo" name="texto_completo" rows="8">{{ $materia->texto_completo }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="imagem">Imagem:</label>
            <input type="file" class="form-control-file fs-4" id="imagem" name="imagem">
        </div>
        <button type="submit" class="btn btn-primary mb-3 fs-4 w-25 d-inline-block float-end" style=" height: 50px;">Salvar</button>
    </form>
</div>
@endsection
