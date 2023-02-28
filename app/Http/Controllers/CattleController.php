<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cattle;

class CattleController extends Controller
{
    public function create (Request $request)
    {
        $cattle = Cattle::create([
            "code" => $request->code,
            "liter" => $request->liter,
            "ration" => $request->ration,
            "weight" => $request->weight,
            "birth" => $request->birth,
        ]);
        return "Gado cadastrado com sucesso!";
    }

    public function searchAll ()
    {
        $cattle = Cattle::all();
        return $cattle;
    }

  public function search ($code)
  {
    $cattle = Cattle::find($code);
    if ($cattle) {
      return $cattle;
    }
    return "Não existe gado com este código.";
  }
}
