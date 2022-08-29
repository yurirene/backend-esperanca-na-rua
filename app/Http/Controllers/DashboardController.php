<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            return view('dashboard.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
