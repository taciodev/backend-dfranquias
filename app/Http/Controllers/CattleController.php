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
    $cattle = Cattle::where("code", "=", $code);
    if ($cattle) {
      return $cattle;
    }
    return "Não existe gado com este código.";
  }

  public function update (Request $request ,$code)
  {
    $cattle = Cattle::where("code", "=", $code)->update($request->all());
    if ($cattle > 0) {
        return "Registro atualizado com sucesso.";
    };
    return "Não foi possivel atualizar esse registro.";
  }

  public function shootDown ($code) {
    $cattle = Cattle::where("code", "=", $code);
    if ($cattle) {
      return $cattle->delete();
    }
    return "Não existe gado com este código.";
  }
}
