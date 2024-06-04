<?php

namespace App\Http\Controllers;

use App\Models\Lanche;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
    function array_find($array, $name, $value) {
        foreach($array as $index => $subArray) {
            if($subArray[$name] == $value) {
                return $index;
            }
        }

        return null;
    }

    public function index(Request $request) {
        $loggedUser = Auth::user();

        if($loggedUser == null) {
            return redirect()->route("loginView");
        }

        $dados = collect();

        // Faturamento por cada venda de lanche
        // Comparação de vendas de cada lanche
        
        $vendas = $loggedUser->vendas()->getModels();
        $countVendas = count($vendas);
        
        // FATURAMENTO POR LANCHE
        $faturamento = [];
        $faturamentoTotal = 0.0;

        for($i = 0; $i < $countVendas; $i++) {
            $lanche = Lanche::find($vendas[$i]->lanche_id);

            $faturamentoCount = count($faturamento);

            $existente = $this->array_find($faturamento, "idLanche", $lanche->id);

            $total = $vendas[$i]->total_price;
            $faturamentoTotal += $total;

            if($existente !== null) {
                $faturamento[$existente]["total"] += $total;
            } else {
                array_push($faturamento, [
                    "idLanche" => $lanche->id,
                    "lanche" => $lanche,
                    "total" => $total
                ]);
            }
        }
        /////////////////////////////////////////////////////////


        // VENDAS DE CADA LANCHE
        $vendasLanche = [];
        $vendasTotais = 0;

        for($i = 0; $i < $countVendas; $i++) {
            $lanche = Lanche::find($vendas[$i]->lanche_id);

            $existente = $this->array_find($vendasLanche, "idLanche", $lanche->id);


            $vendasTotais += $vendas[$i]->quantity;

            if($existente !== null) {
                $vendasLanche[$existente]["total"] += $vendas[$i]->quantity;
            } else {
                array_push($vendasLanche, [
                    "idLanche" => $lanche->id,
                    "lanche" => $lanche,
                    "total" => $vendas[$i]->quantity
                ]);
            }
        }

        return view("graficos", [
            "loggedUser" => $loggedUser,
            "faturamentoTotal" => $faturamentoTotal,
            "vendasTotal" => $vendasTotais,
            "dados" => [
                "faturamento" => $faturamento,
                "vendasLanche" => $vendasLanche
            ]
        ]);
    }
}
