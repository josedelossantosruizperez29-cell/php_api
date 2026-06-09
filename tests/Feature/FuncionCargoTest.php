<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Cargo;
use App\Models\FuncionCargo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FuncionCargoTest extends TestCase
{
    use RefreshDatabase;
    public function test_listar_funciones_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    FuncionCargo::factory()->count(3)->create();

    $response = $this->getJson('/api/funcionCargos');

    $response->assertStatus(200);
}
public function test_no_puede_listar_funciones_sin_autenticacion(): void
{
    $response = $this->getJson('/api/funcionCargos');

    $response->assertStatus(401);
}
public function test_crear_funcion_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $cargo = Cargo::factory()->create();

    $datos = [
        'descripcion_funcion' => 'Gestionar la base de datos',
        'estado' => 'activo',
        'id_cargo' => $cargo->id,
    ];

    $response = $this->postJson('/api/funcionCargos', $datos);

    $response->assertStatus(201);

    $this->assertDatabaseHas('funciocargo', [
        'descripcion_funcion' => 'Gestionar la base de datos',
        'id_cargo' => $cargo->id,
    ]);
}
public function test_mostrar_funcion_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $funcion = FuncionCargo::factory()->create();

    $response = $this->getJson("/api/funcionCargos/{$funcion->id}");

    $response->assertStatus(200);

    $response->assertJson([
        'id' => $funcion->id,
        'descripcion_funcion' => $funcion->descripcion_funcion,
    ]);
}
public function test_actualizar_funcion_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $funcion = FuncionCargo::factory()->create();

    $datosActualizados = [
        'descripcion_funcion' => 'Administrar servidores',
        'estado' => 'inactivo',
        'id_cargo' => $funcion->id_cargo,
    ];

    $response = $this->putJson(
        "/api/funcionCargos/{$funcion->id}",
        $datosActualizados
    );

    $response->assertStatus(200);

    $this->assertDatabaseHas('funciocargo', [
        'id' => $funcion->id,
        'descripcion_funcion' => 'Administrar servidores',
        'estado' => 'inactivo',
    ]);
}
public function test_eliminar_funcion_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $funcion = FuncionCargo::factory()->create();

    $response = $this->deleteJson(
        "/api/funcionCargos/{$funcion->id}"
    );

    $response->assertStatus(200);

    $this->assertDatabaseMissing('funciocargo', [
        'id' => $funcion->id,
    ]);
}
}