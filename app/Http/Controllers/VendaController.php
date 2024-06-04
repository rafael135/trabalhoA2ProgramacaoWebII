<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function createVenda(Request $request) {
        $rememberToken = $request->header("Authorization");

        $loggedUser = User::select()->where("remember_token", "=", $rememberToken)->limit(1)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $lancheId = $request->input("lanche_id", null);
        $quantity = $request->input("quantity", null);
        $date = $request->input("date", null);

        if($lancheId == null | $quantity == null | $date == null) {
            return response()->json([
                "status" => 400
            ], 400);
        }

        $lanche = $loggedUser->lanches()->where("id", "=", $lancheId)->first();

        if($lanche == null) {
            return response()->json([
                "status" => 404
            ], 404);
        }

        $quantity = intval($quantity);

        if($lanche->quantity - $quantity < 0) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $lanche->quantity = $lanche->quantity - $quantity;
        $lanche->save();
        
        // 01/01/2024
        $date = Carbon::parse($date);

        Venda::create([
            "user_id" => $loggedUser->id,
            "lanche_id" => $lanche->id,
            "quantity" => $quantity,
            "total_price" => $quantity * floatval($lanche->price),
            "date" => $date->toDateTimeString()
        ]);

        return response()->json([
            "status" => 201
        ], 201);
    }
}
