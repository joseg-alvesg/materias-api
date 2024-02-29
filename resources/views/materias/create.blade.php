@extends('layouts.main')
@section('title', 'Criar Matéria')
@section('content')
@csrf
<div class="container mt-2 fs-3" style="height: 100vh;">
    <h1 class="mt-3">Criar Matéria</h1>
    <hr class="w-50">
    <form action="/materias/store" method="post" enctype="multipart/form-data" class="w-50 mt-5">
        @csrf
        <div class="form-group mb-3">
            <label for="titulo">titluo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da materia">
        </div>
        <div class="form-group mb-3">
            <label for="descricao">Nome:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da materia">
        </div>
        <div class="form-group mb-3">
            <label for="texto_completo">Descrição:</label>
            <textarea class="form-control" id="texto_completo" name="texto_completo" rows="8"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="imagem">Imagem:</label>
            <input type="file" class="form-control-file fs-4" id="imagem" name="imagem">
        </div>
        <button type="submit" class="btn btn-primary mb-3 fs-4 w-25 d-inline-block float-end" style=" height: 50px;">Criar</button>
    </form>
</div>
@endsection
