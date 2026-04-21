<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'email',
        'direccion',
        'ciudad',
        'canton',
        'provincia',
        'n_telefono',
        'estado',
        'fecha_baja',
        'motivo_baja',
    ];

    // --- Estado helpers ---

    public function isActivo(): bool
    {
        return $this->estado === 'activo';
    }

    public function isBaja(): bool
    {
        return $this->estado === 'baja';
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'id_cliente');
    }
}
