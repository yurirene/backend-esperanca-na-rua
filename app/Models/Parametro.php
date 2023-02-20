<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use Auditable;
    
    public const GRUPO_FORMULARIO = 1;
    public const GRUPO_SISTEMA = 2;
    public const GRUPOS_PARAMETROS = [
        self::GRUPO_FORMULARIO => 'Formulário',
        self::GRUPO_SISTEMA => 'Sistema'
    ];

    protected $table = 'parametros';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'valor' => 'array'
    ];

    public function valores()
    {
        return $this->hasMany(ValorParametro::class, 'parametro_id');
    }
}
