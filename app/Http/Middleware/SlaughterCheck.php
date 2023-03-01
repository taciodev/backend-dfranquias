<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cattle;

class SlaughterCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cattle = Cattle::find($request->code);

        $literOfMilkProducedPerWeek = transformNumber($cattle->literOfMilkProducedPerWeek);
        $kiloOfFeedIngestedPerDay = transformNumber($cattle->kiloOfFeedIngestedPerWeek) / 7;
        $weight = transformNumber($cattle->weight);

        $yearBirthCattle = getYearOfBirth($cattle->birth);
        $currentYear = date('Y');

        dd($birthCattle);

        if (
            ($yearBirthCattle + 5) < $currentYear or
            $literOfMilkProducedPerWeek < 40 or
            $literOfMilkProducedPerWeek < 70 and
            $kiloOfFeedIngestedPerDay > 50 or
            $weight > 540
        ) {
            return $next($request);
        }

        return response()->json(["msg" => "Esse bovino não está dentro dos requisitos para o abate"], 400);
    }
}
