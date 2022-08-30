<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoradorRua extends Model
{
    protected $table = 'morador_ruas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'condicao_fisica' => 'array'
    ];
    
    public function passagemPolicia()
    {
        return $this->belongsTo(PassagemPolicia::class, 'passagem_policia_id');
    }
}
