<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutrasInformacoesMoradorRua extends Model
{
    use Auditable;
    
    protected $table = 'outras_informacoes_morador_ruas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
