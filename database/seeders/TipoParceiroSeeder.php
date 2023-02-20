<?php

namespace Database\Seeders;

use App\Models\TipoParceiro;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TipoParceiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            'Igreja',
            'Centro de Reabilitação',
            'Prefeitura',
            'Médico',
            'Serviço',
            'Abrigo',
            'Outro'
        ];
        foreach ($tipos as $tipo) {
            TipoParceiro::firstOrCreate(['nome' => $tipo]);
        }
    }
}
