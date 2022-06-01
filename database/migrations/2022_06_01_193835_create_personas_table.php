<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id(); //bignint autoincrement llave primary
            $table->string("ci",15);
            $table->string("nombres",50);
            $table->string("apellidos",50);
            $table->string("direccion")->nullable();
            $table->bigInteger("user_id")->nullable()->unsigned();
            //1:1
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
