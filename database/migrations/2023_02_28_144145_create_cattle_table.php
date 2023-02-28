<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cattle', function (Blueprint $table) {
            $table->uuid('code');
            $table->string('liter');
            $table->string('ration');
            $table->string('weight');
            $table->string('birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cattle');
    }
};

// TODO: Código: código da cabeça de gado. ✅
// TODO: Leite: número de litros de leite produzido por semana. ✅
// TODO: Ração: quantidade de alimento ingerida por semana - em quilos. ✅
// TODO: Peso: peso do animal em quilos. ✅
// TODO: Nascimento: data de nascimento do animal. ✅

// OBS
// TODO: O código é um UUID | Não pode existir animais com o mesmo código. ✅
// TODO: A data de nascimento não pode ser futura.
