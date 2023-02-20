<?php

namespace App\Models;

use App\Casts\DateCast;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificacaoMoradorRua extends Model
{
    use Auditable;
    
    protected $table = 'identificacao_morador_ruas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'data_nascimento' => DateCast::class
    ];
}
