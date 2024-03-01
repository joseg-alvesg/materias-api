<?php

namespace Tests\Feature\integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Console\Commands\Seeder;
use Tests\TestCase;

class GetRoutesTest extends TestCase
{
    protected $userLogin = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    /**
     * Test the route "/" is working for guest
     */
    public function test_home_guest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('materias.index');
        $response->assertViewHas('materias');

        $response->assertSeeText('Criar');
        $response->assertDontSeeText('Perfil');
        $response->assertDontSeeText('Sair');
        $response->assertDontSeeText('Dashboard');
        $response->assertSeeText('Login');
        $response->assertSeeText('Registrar');

        foreach ($response->original->getData()['materias'] as $materia) {
            $this->assertArrayHasKey('id', $materia);
            $this->assertArrayHasKey('titulo', $materia);
            $this->assertArrayHasKey('descricao', $materia);
            $this->assertArrayHasKey('data_de_publicacao', $materia);
            $this->assertArrayHasKey('texto_completo', $materia);
        };
    }

    /**
     * Test the route "/" is working for authenticated user
     * login with user
     * test@example.com
     * password
     */
    public function test_home_user(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('materias.index');
        $response->assertViewHas('materias');

        $response->assertSeeText('Criar');
        $response->assertSeeText('Perfil');
        $response->assertSeeText('Sair');
        $response->assertSeeText('Dashboard');
        $response->assertDontSeeText('Login');
        $response->assertDontSeeText('Registrar');
    }

    /**
     * Test the route "/materias/{}" is working for guest
     */

    public function test_show_materia_guest(): void
    {
        $home = $this->get('/');
        $materia = $home->original->getData()['materias']->first();

        $response = $this->get("/materias/{$materia->id}");

        $response->assertStatus(200);

        $response->assertViewIs('materias.materia');
        $response->assertViewHas('materia');

        $response->assertSeeText($materia->titulo);
        $response->assertSeeText($materia->descricao);
        $response->assertSeeText($materia->data_de_publicacao);
        $response->assertSeeText($materia->texto_completo);

        $response->assertDontSeeText('Editar');
        $response->assertDontSeeText('Excluir');
    }

    /**
     * Test the route "/materias/{}" is working for authenticated user
     * login with user
    */
    public function test_show_materia_user(): void
    {
        $this->post('/login', $this->userLogin);

        $home = $this->get('/');
        $materia = $home->original->getData()['materias']->first();

        $response = $this->get("/materias/{$materia->id}");

        $response->assertStatus(200);

        $response->assertViewIs('materias.materia');
        $response->assertViewHas('materia');

        $response->assertSeeText($materia->titulo);
        $response->assertSeeText($materia->descricao);
        $response->assertSeeText($materia->data_de_publicacao);
        $response->assertSeeText($materia->texto_completo);

        $response->assertSeeText('Editar');
        $response->assertSeeText('Excluir');

        $materia = $home->original->getData()['materias'][1];

        $response2 = $this->get("/materias/{$materia->id}");

        $response2->assertStatus(200);

        $response2->assertViewIs('materias.materia');
        $response2->assertViewHas('materia');

        $response2->assertSeeText($materia->titulo);
        $response2->assertSeeText($materia->descricao);
        $response2->assertSeeText($materia->data_de_publicacao);
        $response2->assertSeeText($materia->texto_completo);

        $response2->assertDontSeeText('Editar');
        $response2->assertDontSeeText('Excluir');
    }

    /**
     * Test the route "/materias/dash" is working for authenticated user
     */

    public function test_dash_user(): void
    {
        $this->post('/login', $this->userLogin);
        $userId = auth()->user()->id;

        $response = $this->get('/user/dash');

        $response->assertStatus(200);

        $response->assertViewIs('materias.dash');
        $response->assertViewHas('materias');


        foreach ($response->original->getData()['materias'] as $materia) {
            $this->assertArrayHasKey('id', $materia);
            $this->assertArrayHasKey('titulo', $materia);
            $this->assertArrayHasKey('descricao', $materia);
            $this->assertArrayHasKey('data_de_publicacao', $materia);
            $this->assertArrayHasKey('texto_completo', $materia);
            $this->assertArrayHasKey('user_id', $materia);
        };

        foreach ($response->original->getData()['materias'] as $materia) {
            $this->assertEquals($userId, $materia['user_id']);
        };

        $qty = $response->original->getData()['materias']->count();
        $this->assertEquals(2, $qty);

    }
}
