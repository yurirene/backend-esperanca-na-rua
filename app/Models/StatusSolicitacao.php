<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSolicitacao extends Model
{
    protected $table = 'status_solicitacaos';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    
}
