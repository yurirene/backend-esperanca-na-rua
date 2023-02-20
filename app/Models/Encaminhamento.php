<?php

namespace App\Models;

use App\Models\Auditable as ModelsAuditable;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encaminhamento extends Model
{
    use Auditable;

    protected $table = 'encaminhamentos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $appends = [
        'encaminhado_por',
        'data_formatada',
        'hora_formatada',
        'nome_parceiro'
    ];


    public function getDataFormatadaAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getHoraFormatadaAttribute()
    {
        return $this->created_at->format('H:i:s');
    }

    public function parceiro()
    {
        return $this->belongsTo(Parceiro::class, 'parceiro_id');
    }

    public function getNomeParceiroAttribute()
    {
        return $this->parceiro->nome;
    }

    public function getEncaminhadoPorAttribute()
    {
        $log = ModelsAuditable::where('table', 'encaminhamentos')
            ->where('table_id', $this->id)
            ->orderBy('id', 'asc')
            ->first();
        return $log->nome_usuario;
    }
}
