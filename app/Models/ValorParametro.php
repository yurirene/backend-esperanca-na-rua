<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorParametro extends Model
{
    protected $table = 'valores_parametros';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
