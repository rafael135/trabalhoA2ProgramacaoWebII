<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        $loggedUser = Auth::user();

        if($loggedUser == null) {
            return redirect()->route("loginView");
        }

        $lanches = $loggedUser->lanches()->getModels();

        return view("home", [
            "loggedUser" => $loggedUser,
            "lanches" => $lanches
        ]);
    } 
}
