@extends('layouts.main')

@section('title', 'Criar Matéria')

@section('content')
@csrf
<form action="/materias" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="titulo">titluo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo da materia">
    </div>
    <div class="form-group">
        <label for="descricao">Nome</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da materia">
    </div>
    <div class="form-group">
        <label for="texto_completo">Descrição</label>
        <textarea class="form-control" id="texto_completo" name="texto_completo" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="imagem">Imagem</label>
        <input type="file" class="form-control-file" id="imagem" name="imagem">
    </div>
    <button type="submit" class="btn btn-primary">Criar</button>
</form>
@endsection
