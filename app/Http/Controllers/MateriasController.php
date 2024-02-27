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

}
