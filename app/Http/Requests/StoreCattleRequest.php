<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCattleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "literOfMilkProducedPerWeek" => "required",
            "kiloOfFeedIngestedPerWeek" => "required",
            "weight" => "required",
            "birth" => "required",
        ];
    }

    public function messages()
    {
        return [
            "literOfMilkProducedPerWeek.required" => "Esse campo é obrigatório.",
            "kiloOfFeedIngestedPerWeek.required" => "Esse campo é obrigatório.",
            "weight.required" => "Esse campo é obrigatório.",
            "birth.required" => "Esse campo é obrigatório.",
        ];
    }
}
