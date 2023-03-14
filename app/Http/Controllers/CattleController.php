<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CattleRepositoryInterface;
use App\Http\Requests\StoreCattleRequest;
use Carbon\Carbon;

class CattleController extends Controller
{
    public function index(CattleRepositoryInterface $model, Request $request)
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


    public function show(CattleRepositoryInterface $model, $id)
    {
        $cattle = $model->get($id);

        if ($cattle) {
            return response()->json($cattle, 200);
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }

    public function update(CattleRepositoryInterface $model, Request $request, $id)
    {
        $cattle = $model->get($id);

        if ($cattle) {
            $model->update($request->all(), $id);

            return response()->json(
                ["message" => "Registro atualizado com sucesso."],
                200
            );
        };

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }


    public function destroy(CattleRepositoryInterface $model, $id)
    {
        $cattle = $model->get($id);

        if ($cattle) {
            $cattle = $model->delete($id);

            return response()->json(
                ["message" => "Registro deletado."],
                200
            );
        }

        return response()->json(["message" => "Não foi possivel encontrar esse registro."], 404);
    }

    public function slaughter(CattleRepositoryInterface $model, $id)
    {
        $cattle = $model->get($id);
        $kiloOfFeedIngestedPerDay = $cattle->kiloOfFeedIngestedPerWeek / 7;

        if (
            // TODO: Condição se possui mais de 5 anos.
            $cattle->literOfMilkProducedPerWeek < 40 or
            $cattle->literOfMilkProducedPerWeek < 70 and
            $kiloOfFeedIngestedPerDay > 50 or
            $cattle->weight > 540
        ) {
            $model->update(["downcast" => 1], $id);

            return response()->json(
                ["message" => "Animal abatido."],
                200
            );
        }

        return response()->json(["message" => "Este animal não está nos requisitos para o abate."], 404);
    }


    public function milkProducedInTheWeek(CattleRepositoryInterface $model)
    {
        $cattles = $model->all();
        $sum = 0;
        foreach ($cattles as $item) {
            $milk = $item->literOfMilkProducedPerWeek;
            $sum += $milk;
        }

        return response()->json(["sum" => $sum], 200);
    }


    public function rationNeededPerWeek(CattleRepositoryInterface $model)
    {
        $cattles = $model->all();
        $sum = 0;
        foreach ($cattles as $item) {
            $ration = transformNumber($item->kiloOfFeedIngestedPerWeek);
            $sum += $ration;
        }

        return response()->json(["sum" => $sum], 200);
    }

    public function checkRationByAge(CattleRepositoryInterface $model)
    {
        // TODO: AVALIAR ESSA FUNÇÃO
        $cattles = $model->all();
        $sum = 0;
        foreach ($cattles as $item) {
            $birthCattle = Carbon::createFromFormat('Y-m-d', $item->birth);
            $current = Carbon::now();

            $daysCattle = $birthCattle->diffInDays($current);

            if ($daysCattle < 365) {
                $ration = transformNumber($item->kiloOfFeedIngestedPerWeek);
                $sum += $ration;
            }
        }

        return response()->json(["sum" => "{$sum}Kg"], 200);
    }
}
