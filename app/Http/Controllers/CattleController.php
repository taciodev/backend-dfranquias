<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CattleRepositoryInterface;
use App\Http\Requests\StoreCattleRequest;

class CattleController extends Controller
{
    public function index(CattleRepositoryInterface $model)
    {
        return $model->all();
    }


    public function store(CattleRepositoryInterface $model, StoreCattleRequest $request)
    {
        if ($model->create($request->all())) {
            return response()->json(["message" => "Bovino cadastrado com sucesso."], 201);
        }

        return response()->json(["message" => "Não foi cadastrar esse bovino."], 404);
    }


    public function show(CattleRepositoryInterface $model, $code)
    {
        $cattle = $model->get($code);

        if ($cattle) {
            return response()->json($cattle, 200);
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }

    public function update(CattleRepositoryInterface $model, Request $request, $code)
    {
        $cattle = $model->get($code);

        if ($cattle) {
            $model->update($request->all(), $code);

            return response()->json(
                ["message" => "Registro atualizado com sucesso."],
                200
            );
        };

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }


    public function destroy(CattleRepositoryInterface $model, $code)
    {
        $cattle = $model->get($code);

        if ($cattle) {
            $cattle = $model->delete($code);

            return response()->json(
                ["message" => "Registro deletado."],
                200
            );
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }


    public function milkQuantifyReportForTheWeek(CattleRepositoryInterface $model)
    {
        $cattles = $model->all();
        $sumOfMilk = 0;
        foreach ($cattles as $item) {
            $formatNumber = (int)preg_replace("/\D/", "", $item->literOfMilkProducedPerWeek);
            $sumOfMilk += $formatNumber;
        }

        return response()->json("{$sumOfMilk}L", 200);
    }


    public function reportRationNeededPerWeek(CattleRepositoryInterface $model)
    {
        $cattles = $model->all();
        $sumOfRation = 0;
        foreach ($cattles as $item) {
            $formatNumber = (int)preg_replace("/\D/", "", $item->kiloOfFeedIngestedPerWeek);
            $sumOfRation += $formatNumber;
        }

        return response()->json("{$sumOfRation}Kg", 200);
    }
}
