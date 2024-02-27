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
                'texto_completo' => 'Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.',
                'imagem' => $this->saveImage('example_images/sun.jpg'),
            ],
            [
                'titulo' => 'Título da Matéria 2',
                'descricao' => 'Descrição da Matéria 2',
                'texto_completo' => 'Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.',
                'imagem' => $this->saveImage('example_images/blue_bird.jpg'),
            ],
            [
                'titulo' => 'Título da Matéria 3',
                'descricao' => 'Descrição da Matéria 3',
                'texto_completo' => 'Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.',
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
