<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materias::all();
        return view('materias.index', ['materias' => $materias]);
    }

    /**
     * Show the especific post from id.
     *
     * @id from request
     * @return \Illuminate\Http\Response
     */
    public function materia()
    {
        $id = Request('id');
        $materia = Materias::find($id);
        return view('materias.materia', ['materia' => $materia]);
    }

    /**
     * Show the form to create a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()) {
            return redirect('/')->with('error', 'Você precisa estar logado para criar uma matéria');
        }
        return view('materias.create');
    }

    public function edit(request $request)
    {
        $id = Request('id');
        $materia = Materias::find($id);
        if(auth()->user()->id != $materia->user_id) {
            return redirect('/')->with('error', 'Você não tem permissão para editar essa matéria');
        }
        return view('materias.edit', ['materia' => $materia]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $materia = Materias::find($id);
        if(auth()->user()->id != $materia->user_id) {
            return redirect('/')->with('error', 'Você não tem permissão para excluir essa matéria');
        }
        $materia->delete();
        return redirect('/');
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
        if (!auth()->user()) {
            return redirect('/')->with('error', 'Você precisa estar logado para criar uma matéria');
        }
        $materia = new Materias();
        $materia->titulo = $request->titulo;
        $materia->descricao = $request->descricao;
        $materia->texto_completo = $request->texto_completo;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $materia->imagem = $this->imageUpload($request->imagem);
        }
        $materia->user_id = auth()->user()->id;
        $materia->save();

        $id = $materia->id;
        return redirect('/materias/' . $id);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $materia = Materias::find($id);
        if(auth()->user()->id != $materia->user_id) {
            return redirect('/')->with('error', 'Você não tem permissão para editar essa matéria' . auth()->user()->id);
        }
        $materia->titulo = $request->titulo;
        $materia->descricao = $request->descricao;
        $materia->texto_completo = $request->texto_completo;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $materia->imagem = $this->imageUpload($request->imagem);
        }
        $materia->user_id = auth()->user()->id;
        $materia->save();
        return redirect('/materias/' . $id);
    }

    public function materiasByUser(Request $request)
    {
        $user_id = auth()->user()->id;
        $materias = Materias::where('user_id', $user_id)->get();
        return view('materias.dash', ['materias' => $materias]);
    }
}
