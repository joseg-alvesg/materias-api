<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasTableSeeder extends Seeder
{

    public function __construct()
    {
        $this->deleteImage('images');
    }

    public function run(): void
    { $materias = [
            [
                'titulo' => 'Título da Matéria 1',
                'descricao' => 'Descrição da Matéria 1',
                'texto_completo' => 'Texto completo da Matéria 1',
                'imagem' => $this->saveImage('example_images/sun.jpg'),
            ],
            [
                'titulo' => 'Título da Matéria 2',
                'descricao' => 'Descrição da Matéria 2',
                'texto_completo' => 'Texto completo da Matéria 2',
                'imagem' => $this->saveImage('example_images/blue_bird.jpg'),
            ],
            [
                'titulo' => 'Título da Matéria 3',
                'descricao' => 'Descrição da Matéria 3',
                'texto_completo' => 'Texto completo da Matéria 3',
                'imagem' => $this->saveImage('example_images/green_road.jpg'),
            ]
        ];

        DB::table('materias')->insert($materias);
    }

    private function deleteImage()
    {
        $destinationPath = public_path('images');
        if(file_exists($destinationPath)) {
            $files = glob($destinationPath . '/*');
            foreach($files as $file) {
                if(is_file($file)) {
                    unlink($file);
                } else {
                    rmdir($file);
                }
            }
            rmdir($destinationPath);
        }

    }

    private function saveImage($imagePath)
    {
        $imageContent = file_get_contents(public_path($imagePath));
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $hash = md5($imageContent . strtotime('now')) . '.' . $extension;
        $destinationPath = public_path('images');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        file_put_contents($destinationPath . '/' . $hash, $imageContent);
        return $hash;
    }
}
