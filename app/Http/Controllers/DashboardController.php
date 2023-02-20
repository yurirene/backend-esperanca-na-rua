<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            if (in_array(auth()->user()->perfil->name, ['parceiro_administrador', 'parceiro_operador'])) {
                return redirect()->route('dashboard.parceiro.index');
            }
            return view('dashboard.index');
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getFile());
        }
    }

    public function parceiro()
    {
        $parceiro = auth()->user()->parceiros->first();
        return view('dashboard.parceiro');
    }
}
