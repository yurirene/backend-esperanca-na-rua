<?php

namespace App\Http\Controllers;

use App\DataTables\MoradorRuaDataTable;
use Illuminate\Http\Request;

class MoradorRuaController extends Controller
{
    public function index(MoradorRuaDataTable $dataTable)
    {
        try {
            return $dataTable->render('morador-rua.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
