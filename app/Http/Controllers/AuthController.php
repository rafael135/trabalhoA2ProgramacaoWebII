<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView(Request $request) {
        $errors = [];
        if($request->session()->has("errors") == true) {
            $errors = $request->session()->get("errors");
        }

        return view("login", [
            "errors" => $errors
        ]);
    }

    public function loginAction(LoginRequest $request) {
        $result = $request->authenticate();

        if($result == false) {
            return redirect()->route("loginView")->with("errors", [
                "incorrectEmailOrPassowrd" => true
            ]);
        }

        return redirect()->route("home.view");
    }

    public function registerView(Request $request) {
        $errors = [];
        if($request->session()->has("errors") == true) {
            $errors = $request->session()->get("errors");
        }
        
        return view("register", [
            "errors" => $errors
        ]);
    }

    public function registerAction(RegisterRequest $request) {
        $result = $request->authenticate();

        if($result == true) {
            return redirect()->route("homeView");
        }
    }

    public function logoutAction(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route("homeView");
    }
}
