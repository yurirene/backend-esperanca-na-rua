<?php

namespace App\Services;

use App\Models\MoradorRua;
use Illuminate\Support\Collection;

class MoradorRuaService
{

    public static function store(array $request) : ?MoradorRua
    {
        try {
            return MoradorRua::create([
                'deseja_ajuda' => $request['deseja_ajuda'] == 'S',
                'condicao_fisica' => $request['condicao_fisica'],
                'genero' => $request['genero'],
                'nome' => $request['nome']
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            throw $th;
        }
    }
}
