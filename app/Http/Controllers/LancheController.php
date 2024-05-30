<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterLancheRequest;
use App\Models\Lanche;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LancheController extends Controller
{
    public function registerLanche(RegisterLancheRequest $request) {
        $loggedUser = Auth::user();

        if($loggedUser == null) {
            return back();
        }

        $user_id = 1;//$loggedUser->id;
        $name = $request->input("name", null);
        $description = $request->input("description", null);
        $price = $request->input("price", null);
        $image = $request->file("image", null);

        $errors = collect();

        if($name == null) {
            $errors->push([
                "name" => "Nome não preenchido"
            ]);
        }

        if($price == null) {
            $errors->push([
                "price" => "Preço não preenchido"
            ]);
        }

        if($description == null) {
            $errors->push([
                "description" => "Descrição não preenchido"
            ]);
        }

        if($image == null) {
            $errors->push([
                "image" => "Imagem não escolhida"
            ]);
        }

        $imageName = Hash::make($image->getClientOriginalName());
        $url = $image->storeAs("$user_id/images", $imageName . $image->getExtension());

        if($errors->count() > 0) {
            return back()->with($errors);
        }

        Lanche::create([
            "user_id"=> $user_id,
            "name"=> $name,
            "description"=> $description,
            "price" => $price,
            "image_url" => $url
        ]);

        return redirect()->route("homeView");

    }

    public function getLanche(Request $request, int $lanche_id) {
        $loggedUser = Auth::user();
        

        if($loggedUser == null) {
            return back();
        }

        $lanche = $loggedUser->lanches()->where("id", $lanche_id)->first()->getModel();

        if($lanche == null) {
            return response()->json([
                "status" => 404
            ], 404);
        }

        return response()->json([
            "lanche" => $lanche,
            "status" => 200
        ], 200);
        
    }
}
