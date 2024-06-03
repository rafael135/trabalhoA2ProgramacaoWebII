<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
    public function index(Request $request) {
        $loggedUser = Auth::user();

        if($loggedUser == null) {
            return redirect()->route("loginView");
        }

        $dados = collect();

        //TODO

        return view("graficos", [
            "loggedUser" => $loggedUser,
            "dados" => $dados
        ]);
    }
}
