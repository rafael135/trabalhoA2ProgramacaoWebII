<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterLancheRequest;
use App\Models\Lanche;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LancheController extends Controller
{
    public function registerLanche(RegisterLancheRequest $request) {
        $loggedUser = Auth::user();

        if($loggedUser == null) {
            return back();
        }

        $user_id = $loggedUser->id;
        $name = $request->input("name", null);
        $description = $request->input("description", null);
        $price = $request->input("price", null);
        $quantity = $request->input("quantity", null);
        $image = $request->file("image", null);

        //dd($user_id, $name, $description, $price, $quantity, $image);

        $errors = collect();

        if($name == null) {
            $errors->push([
                "target" => "name",
                "msg" => "Nome não preenchido"
            ]);
        }

        if($price == null) {
            $errors->push([
                "target" => "price",
                "msg" => "Preço não preenchido"
            ]);
        }

        if($quantity == null) {
            $errors->push([
                "target" => "quantity",
                "msg" => "Quantidade não preenchida"
            ]);
        }

        if($description == null) {
            $errors->push([
                "target" => "description",
                "msg" => "Descrição não preenchido"
            ]);
        }

        if($image == null) {
            $errors->push([
                "target" => "image",
                "msg" => "Imagem não escolhida"
            ]);
        }

        if($errors->count() > 0) {
            return back()->with($errors);
        }

        $imageName = Hash::make($image->getClientOriginalName());
        $imageName = str_replace("/", "", $imageName);

        $url = "";

        try {
            $url = Storage::disk("public")->putFileAs("/users/$user_id/images", $image, $imageName.".".$image->getClientOriginalExtension());
        } catch(Exception $e) {
            return back()->with("errors", [
                "serverError" => $e->getMessage()
            ]);
        }
        

        Lanche::create([
            "user_id"=> $user_id,
            "name"=> $name,
            "description"=> $description,
            "price" => $price,
            "quantity" => $quantity,
            "image_url" => $url
        ]);

        return redirect()->route("homeView");

    }

    public function getLanche(Request $request, int $id) {
        $rememberToken = $request->header("Authorization");

        $loggedUser = User::select()->where("remember_token", "=", $rememberToken)->limit(1)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $lanche = $loggedUser->lanches()->where("id", $id)->first()->getModel();

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

    public function deleteLanche(Request $request, int $id) {
        $rememberToken = $request->header("Authorization");

        $loggedUser = User::select()->where("remember_token", "=", $rememberToken)->limit(1)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $lanche = $loggedUser->lanches()->where("id", "=", $id)->first()->getModel();

        if($lanche == null) {
            return response()->json([
                "status" => 404
            ], 404);
        }

        $lanche->delete();

        return response()->json([
            "status" => 200
        ], 200);


    }

    public function updateLanche(Request $request, int $id) {
        $rememberToken = $request->header("Authorization");

        $loggedUser = User::select()->where("remember_token", "=", $rememberToken)->limit(1)->first();

        if($loggedUser == null) {
            return response()->json([
                "status" => 403
            ], 403);
        }

        $lanche = $loggedUser->lanches()->where("id", "=", $id)->first()->getModel();

        if($lanche == null) {
            return response()->json([
                "status" => 404
            ], 404);
        }

        $name = $request->input("name", null);
        $description = $request->input("description", null);
        $price = $request->input("price", null);
        $quantity = $request->input("quantity", null);
        $image = $request->file("image", null);

        $errors = collect();

        if($name == null) {
            $errors->push([
                "target" => "name",
                "msg" => "Nome não preenchido"
            ]);
        }

        if($description == null) {
            $errors->push([
                "target" => "description",
                "msg" => "Descrição não preenchida"
            ]);
        }

        if($price == null) {
            $errors->push([
                "target" => "price",
                "msg" => "Preço não preenchido"
            ]);
        }

        if($quantity == null) {
            $errors->push([
                "target" => "quantity",
                "msg" => "Quantidade não preenchida"
            ]);
        }

        if($errors->count() > 0) {
            return response()->json([
                "errors" => $errors,
                "status" => 400
            ], 400);
        }

        $image_url = $lanche->image_url;

        if($image != null && $image_url != null) {
            try {
                Storage::disk("public")->delete($image_url);
            } catch (Exception $e) {
                return response()->json([
                    "msg" => $e->getMessage(),
                    "status" => 500
                ], 500);
            }
        }

        if($image != null) {
            $imageName = Hash::make($image->getClientOriginalName());
            $imageName = str_replace("/", "", $imageName);

            try {
                $image_url = Storage::disk("public")
                    ->putFileAs("/users/$loggedUser->id/images", $image, $imageName . "." . $image->getClientOriginalExtension());
            } catch(Exception $e) {
                return response()->json([
                    "msg" => $e->getMessage(),
                    "status" => 500
                ], 500);
            }
            
        }

        $lanche->update([
            "name"=> $name,
            "description"=> $description,
            "price"=> $price,
            "quantity" => $quantity,
            "image_url" => $image_url
        ]);

        return response()->json([
            "lanche" => $lanche,
            "status" => 200
        ], 200);
        
    }
}
