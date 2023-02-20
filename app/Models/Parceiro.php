<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    use Auditable;
    protected $table = 'parceiros';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'parceiros_usuarios');
    }
}
