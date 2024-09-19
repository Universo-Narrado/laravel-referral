<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contas_indicacoes', function (Blueprint $table) {
            $table->bigIncrements('con_ind_id');
            $table->morphs('con_ind_morph');
            $table->string('con_ind_nome');
            $table->string('con_ind_codigo')->unique()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contas_indicacoes');
    }
};
