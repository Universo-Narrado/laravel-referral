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
        Schema::create('indicacoes', function (Blueprint $table) {
            $table->bigIncrements('ind_id');
            $table->unsignedBigInteger('con_ind_id')->index();
            $table->morphs('ind_tipo');  //prefixo_id  prefixo_type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('indicacoes');
    }
};
