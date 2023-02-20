<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rotas()
    {
        return $this->belongsToMany(Rotas::class, 'perfil_rota', 'perfil_id', 'rota_id');
    }
}
