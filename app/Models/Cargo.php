<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cargo extends Model
{
    // modelo de cargo

    use hasFactory;
    protected $fillable = [
        'nombre_cargo',
        'descripcion',
    ];

    public function empleados()
    {
        return $this->hasMany(Empleados::class, 'id_cargo');
    }

    public function funcioCargo()
    {
        return $this->hasMany(FuncionCargo::class, 'id_cargo');
    }
}
