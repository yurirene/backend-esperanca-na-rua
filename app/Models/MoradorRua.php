<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoradorRua extends Model
{
    protected $table = 'morador_ruas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
