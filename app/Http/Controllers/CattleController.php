<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cattle;

class CattleController extends Controller
{
    public function index()
    {
        return Cattle::all();
    }


    public function store(Request $request)
    {
        if (Cattle::create($request->all())) {
            return response()->json(["message" => "Bovino cadastrado com sucesso."], 201);
        }

        return response()->json(["message" => "Não foi cadastrar esse bovino."], 404);
    }


    public function show($code)
    {
        $cattle = Cattle::where("code", "=", $code)->get();
        if (sizeof($cattle) != 0) {
            return response()->json($cattle, 200);
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }

    public function update(Request $request, $code)
    {
        $cattle = Cattle::where("code", "=", $code)->update($request->all());
        if ($cattle > 0) {
            return response()->json(
                ["message" => "Registro atualizado com sucesso."],
                200
            );
        };

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }


    public function destroy($code)
    {
        $cattle = Cattle::where("code", "=", $code)->delete();
        if ($cattle != 0) {
            return response()->json(
                ["message" => "Registro deletado."],
                200
            );
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }


    public function milkQuantifyReportForTheWeek()
    {
        $cattles = Cattle::all();
        $sumOfMilk = 0;
        foreach ($cattles as $item) {
            $formatNumber = (int)preg_replace("/\D/", "", $item->literOfMilkProducedPerWeek);
            $sumOfMilk += $formatNumber;
        }

        return "{$sumOfMilk}L";
    }


    public function reportRationNeededPerWeek()
    {
        $cattles = Cattle::all();
        $sumOfRation = 0;
        foreach ($cattles as $item) {
            $formatNumber = (int)preg_replace("/\D/", "", $item->kiloOfFeedIngestedPerWeek);
            $sumOfRation += $formatNumber;
        }

        return "{$sumOfRation}Kg";
    }
}
