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

    /**
     * Show the form to edit a post.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (!auth()->user()) {
            return redirect('/')->with('error', 'Você precisa estar logado para editar uma matéria');
        }
        $id = Request('id');
        $materia = Materias::find($id);
        if(auth()->user()->id != $materia->user_id) {
            return redirect('/')->with('error', 'Você não tem permissão para editar essa matéria');
        }
        return view('materias.edit', ['materia' => $materia]);
    }

    /**
     * Delete a post.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if(!auth()->user()) {
            return redirect('/')->with('error', 'Você precisa estar logado para excluir uma matéria');
        }
        $id = $request->id;
        $materia = Materias::find($id);
        if(auth()->user()->id != $materia->user_id) {
            return redirect('/')->with('error', 'Você não tem permissão para excluir essa matéria');
        }
        $materia->delete();
        return redirect('/');
    }

    /**
     * Upload image to public/images
     *
     * @return string hash name of the image
     */
    private function imageUpload($image)
    {
        $ext = $image->extension();
        $name = md5($image->getClientOriginalName() . strtotime("now")) . "." . $ext;
        $image->move(public_path('images'), $name);
        return $name;
    }

    /**
     * Store a new post.
     * uses imageUpload to upload the image
     * come from the request of the form create
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update a post.
     * uses imageUpload to upload the image
     * come from the request of the form edit
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!auth()->user()) {
            return redirect('/')->with('error', 'Você precisa estar logado para editar uma matéria');
        }
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

    /**
     * Show the posts from the logged user.
     *
     * @return \Illuminate\Http\Response
     */
    public function materiasByUser()
    {
        $user_id = auth()->user()->id;
        $materias = Materias::where('user_id', $user_id)->get();
        return view('materias.dash', ['materias' => $materias]);
    }
}
