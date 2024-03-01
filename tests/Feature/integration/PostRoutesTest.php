<?php

namespace Tests\Feature\integration;

use App\Models\Materias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PostRoutesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * test the route "/materias/create" is not working for guest
     */

    protected $userLogin = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    public function test_create_guest_user(): void
    {
        Artisan::call('app:seeder');

        $response = $this->get('/materias/create');

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Você precisa estar logado para criar uma matéria');

        $response = $this->post('/materias/store', [
            'titulo' => 'Título da Matéria 1',
            'descricao' => 'Descrição da Matéria 1',
            'texto_completo' => 'Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Você precisa estar logado para criar uma matéria');
    }

    /**
     * test the route "/materias/create" is working for logged user
     */
    public function test_create_logged_user(): void
    {
        Artisan::call('app:seeder');

        $user = \App\Models\User::get()->first();
        $this->actingAs($user);

        $imagePath = public_path('example_images/sun.jpg');
        $this->assertFileExists($imagePath);

        $response = $this->get('/materias/create');

        $response->assertStatus(200);
        $response->assertViewIs('materias.create');

        $response = $this->post('/materias/store', [
            'titulo' => 'test',
            'descricao' => 'test',
            'texto_completo' => 'teste',
            'imagem' => $imagePath,
        ]);

        $last = Materias::latest()->first();
        $response->assertStatus(302);
        $response->assertRedirect('/materias/' . $last->id);
        $this->assertEquals('test', $last->titulo);
        $this->assertEquals('test', $last->descricao);
        $this->assertEquals('teste', $last->texto_completo);
        $this->assertEquals($user->id, $last->user_id);
        $this->assertFileExists(public_path('images/' . $last->imagem));
    }

    /**
     * test the route "/materias/edit" is not working for guest
     */
    public function test_edit_guest_user(): void
    {
        Artisan::call('app:seeder');
        $materia = Materias::get()->first();

        $response = $this->get('/materias/edit/' . $materia->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Você precisa estar logado para editar uma matéria');

        $response = $this->post('/materias/update', [
            'id' => $materia->id,
            'titulo' => 'Título da Matéria 1',
            'descricao' => 'Descrição da Matéria 1',
            'texto_completo' => 'Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint consectetur cupidatat.',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Você precisa estar logado para editar uma matéria');
    }

    /**
     * test the route "/materias/edit" is working for logged user
     */
    public function test_edit_logged_user(): void
    {
        Artisan::call('app:seeder');
        $user = \App\Models\User::get()->first();
        $this->actingAs($user);
        $materia = Materias::where('user_id', $user->id)->get()->first();

        $response = $this->get('/materias/edit/' . $materia->id);

        $image_path = public_path('example_images/blue_bird.jpg');
        $this->assertFileExists($image_path);

        $response->assertStatus(200);
        $response->assertViewIs('materias.edit');
        $response->assertViewHas('materia');

        $response = $this->post('/materias/update', [
            'id' => $materia->id,
            'titulo' => 'test',
            'descricao' => 'test',
            'texto_completo' => 'teste',
            'imagem' => $image_path,
        ]);

        $materia = Materias::where('user_id', $user->id)->get()->first();

        $response->assertStatus(302);
        $response->assertRedirect('/materias/' . $materia->id);
        $this->assertEquals('test', $materia->titulo);
        $this->assertEquals('test', $materia->descricao);
        $this->assertEquals('teste', $materia->texto_completo);
        $this->assertFileExists(public_path('images/' . $materia->imagem));
    }

    /**
     * test the route "/materias/delete" is not working for guest
     */
    public function test_delete_guest_user(): void
    {
        Artisan::call('app:seeder');
        $materia = Materias::get()->first();

        $response = $this->get('/materias/delete/' . $materia->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Você precisa estar logado para excluir uma matéria');
    }

    /**
     * test the route "/materias/delete" is working for logged user
     */
    public function test_delete_logged_user(): void
    {
        Artisan::call('app:seeder');
        $user = \App\Models\User::get()->first();
        $this->actingAs($user);
        $count1 = Materias::where('user_id', $user->id)->count();
        $materia = Materias::where('user_id', $user->id)->get()->first();

        $this->assertEquals(2, $count1);

        $response = $this->get('/materias/delete/' . $materia->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $count2 = Materias::where('user_id', $user->id)->count();
        $materia2 = Materias::where('user_id', $user->id)->get()->first();
        $this->assertNotEquals($materia->id, $materia2->id);

        $this->assertNotEquals($count1, $count2);
    }
}
