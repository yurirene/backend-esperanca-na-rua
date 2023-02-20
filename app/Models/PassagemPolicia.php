<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassagemPolicia extends Model
{
    protected $table = 'passagem_policias';
    protected $guaded = ['id', 'created_at', 'updated_at'];
}
