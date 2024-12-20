<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocktailsTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
{
    Schema::create('cocktails', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('image');
        $table->string('category')->nullable();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
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
        Schema::dropIfExists('cocktails');
    }
}