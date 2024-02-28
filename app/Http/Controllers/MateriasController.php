<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    public function index()
    {
        $materias = Materias::all();
        return view('materias.index', ['materias' => $materias]);
    }

    public function materia()
    {
        $id = Request('id');
        $materia = Materias::find($id);
        return view('materias.materia', ['materia' => $materia]);
    }

    public function create()
    {
        return view('materias.create');
    }

    public function edit()
    {
        $id = Request('id');
        $materia = Materias::find($id);
        return view('materias.edit', ['materia' => $materia]);
    }

    private function imageUpload($image)
    {
        $ext = $image->extension();
        $name = md5($image->getClientOriginalName() . strtotime("now")) . "." . $ext;
        $image->move(public_path('images'), $name);
        return $name;
    }

    public function store(Request $request)
    {
        $materia = new Materias();
        $materia->titulo = $request->titulo;
        $materia->descricao = $request->descricao;
        $materia->texto_completo = $request->texto_completo;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $materia->imagem = $this->imageUpload($request->imagem);
        }
        $materia->save();
        $id = $materia->id;
        return redirect('/materias/' . $id);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $materia = Materias::find($id);
        $materia->titulo = $request->titulo;
        $materia->descricao = $request->descricao;
        $materia->texto_completo = $request->texto_completo;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $materia->imagem = $this->imageUpload($request->imagem);
        }
        $materia->save();
        return redirect('/materias/' . $id);
    }

}
