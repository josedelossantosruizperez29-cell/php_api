<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cargo;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;  

class CargoTest extends TestCase
{
  use RefreshDatabase;
public function test_listar_cargos_solo_autorizados(): void
{
    Sanctum::actingAs(User::factory()->create());

    Cargo::factory()->count(3)->create();

    $response = $this->getJson('/api/cargos');

    $response->assertStatus(200);
}
public function test_no_puede_listar_cargos_sin_autenticacion(): void
{
    $response = $this->getJson('/api/cargos');

    $response->assertStatus(401);
}

public function test_crear_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $datos = [
        'nombre_cargo' => 'Desarrollador Backend',
        'descripcion' => 'Encargado de desarrollar APIs'
    ];

    $response = $this->postJson('/api/cargos', $datos);

    $response->assertStatus(201);

    $this->assertDatabaseHas('cargos', [
        'nombre_cargo' => 'Desarrollador Backend'
    ]);
}

public function test_mostrar_un_solo_cargo_por_id(): void
{
    Sanctum::actingAs(User::factory()->create());

    $cargo = Cargo::factory()->create();

    $response = $this->getJson("/api/cargos/{$cargo->id}");

    $response->assertStatus(200);

    $response->assertJson([
        'id' => $cargo->id,
        'nombre_cargo' => $cargo->nombre_cargo,
    ]);
}

public function test_actualizar_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $cargo = Cargo::factory()->create();

    $datosActualizados = [
        'nombre_cargo' => 'Arquitecto de Software',
        'descripcion' => 'Diseña la arquitectura del sistema'
    ];

    $response = $this->putJson("/api/cargos/{$cargo->id}", $datosActualizados);

    $response->assertStatus(200);

    $this->assertDatabaseHas('cargos', [
        'id' => $cargo->id,
        'nombre_cargo' => 'Arquitecto de Software',
        'descripcion' => 'Diseña la arquitectura del sistema'
    ]);
}

public function test_eliminar_cargo(): void
{
    Sanctum::actingAs(User::factory()->create());

    $cargo = Cargo::factory()->create();

    $response = $this->deleteJson("/api/cargos/{$cargo->id}");

    $response->assertStatus(200);

    $this->assertDatabaseMissing('cargos', [
        'id' => $cargo->id
    ]);
}

}