<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasTableSeeder extends Seeder
{
    private $_materias = [
        [
            'titulo' => 'Título da Matéria 1',
            'descricao' => 'Descrição da Matéria 1',
            'texto_completo' => 'Texto completo da Matéria 1',
            'imagem' => 'url.da.imagem.com',
        ],
        [
            'titulo' => 'Título da Matéria 2',
            'descricao' => 'Descrição da Matéria 2',
            'texto_completo' => 'Texto completo da Matéria 2',
            'imagem' => 'url.da.imagem.com',
        ],
    ];
    public function run(): void
    {
        DB::table('materias')->insert($this->_materias);
    }
}
