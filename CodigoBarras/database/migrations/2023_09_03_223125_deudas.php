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
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad', 12, 2);
            $table->unsignedBigInteger('deudor'); 
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->boolean('pagado')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('deudas');
    }
};
