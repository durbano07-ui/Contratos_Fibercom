<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'role', 'cedula'])]
#[Hidden(['remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    // --- Role helpers ---
    public function getAuthPassword()
    {
        return '';
    }

    public function isAdministrador(): bool
    {
        return $this->role === 'administrador';
    }

    public function isAdministrativo(): bool
    {
        return $this->role === 'administrativo';
    }

    public function isTecnico(): bool
    {
        return $this->role === 'tecnico';
    }

    // --- Relationships ---

    public function contracts()
    {
        return $this->hasMany(\App\Models\Contract::class, 'id_usuario');
    }

    public function contratos_asignados()
    {
        return $this->hasMany(\App\Models\Contract::class, 'id_tecnico');
    }
}
