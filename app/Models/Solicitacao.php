<?php

namespace App\Models;

use App\Traits\GenericTrait;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use GenericTrait;

    protected $table = 'solicitacaos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];


    public function morador()
    {
        return $this->belongsTo(MoradorRua::class, 'morador_rua_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusSolicitacao::class, 'status_solicitacao_id');
    }

    public function tipoDestino()
    {
        return $this->belongsTo(TipoDestino::class, 'tipo_destino_id');
    }

    public function getStatusFormatadoAttribute()
    {
        return '<span class="badge badge-pill badge-' . $this->status->color . '">' . $this->status->descricao . '</span>';
    }

    public function getCriadoEmAttribute()
    {
        return $this->created_at->format('d/m/Y ');
    }
    public function getCriadoHoraEmAttribute()
    {
        return $this->created_at->format('H:i:s');
    }

    public function getTipoDestinoFormatadoAttribute()
    {
        return $this->tipoDestino->descricao;
    }

    public function solicitante()
    {
        return $this->belongsTo(User::class,'solicitante_id');
    }

    public function atendente()
    {
        return $this->belongsTo(User::class,'atendente_id');
    }

}
