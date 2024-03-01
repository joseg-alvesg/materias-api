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

        $response = $this->get('/materias/create');

        $response->assertStatus(200);

        $response->assertViewIs('materias.create');

        $response = $this->post('/materias/store', [
            'titulo' => 'test',
            'descricao' => 'test',
            'texto_completo' => 'teste',
        ]);

        $last = Materias::latest()->first();
        $response->assertStatus(302);
        $response->assertRedirect('/materias/' . $last->id);
        $this->assertEquals('test', $last->titulo);
        $this->assertEquals('test', $last->descricao);
        $this->assertEquals('teste', $last->texto_completo);
        $this->assertEquals($user->id, $last->user_id);

    }
}
