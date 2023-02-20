<?php

namespace App\Services;

use App\Models\Modulo;
use App\Models\Rotas;
use Illuminate\Support\Facades\DB;

class RotaService
{
    /**
     * Retorna os Módulos e suas Rotas
     *
     * @return array
     */
    public static function getRotasFormulario(): array
    {
        try {
            return Modulo::with('rotas')
                ->get()
                ->pluck('nome', 'id')
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Salva a rota dos módulos e salva o módulo caso não exista
     *
     * @param array $request
     * @return Rotas|null
     */
    public static function store(array $request): ?Rotas
    {
        DB::beginTransaction();
        try {
            $modulo = Modulo::firstOrCreate(
                [
                    'name' => $request['modulo']
                ],
                [
                    'name' => $request['modulo'],
                    'nome' => ucwords(str_replace('_', ' ', $request['modulo']))
                ]
            );
            $rota = Rotas::updateOrCreate(
                [
                    'uri' => $request['uri']
                ],
                [
                    'nome' => $request['nome'],
                    'uri' => $request['uri'],
                    'modulo_id' => $modulo->id
                ]
            );
            DB::commit();
            return $rota;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
