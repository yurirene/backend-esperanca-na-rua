<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\GenericTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MoradorRua extends Model
{
    use GenericTrait;

    protected $table = 'morador_ruas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'condicao_fisica' => 'array'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getFotoAttribute()
    {
        return $this->path_foto ?: 'sitev2/assets/images/profile-img.jpg';
    }

    public function passagemPolicia()
    {
        return $this->belongsTo(PassagemPolicia::class, 'passagem_policia_id');
    }

    public function identificacao()
    {
        return $this->hasOne(IdentificacaoMoradorRua::class, 'morador_rua_id');
    }

    public function outraInformacao()
    {
        return $this->hasOne(OutrasInformacoesMoradorRua::class, 'morador_rua_id');
    }

    public function encaminhamentos()
    {
        return $this->hasMany(Encaminhamento::class, 'morador_rua_id');
    }
}
