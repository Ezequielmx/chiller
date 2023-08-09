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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('razon_social');
            $table->string('cuit');
            $table->string('direccion', 500);
            $table->string('telefono');
            $table->string('email');
            $table->string('web')->nullable();
            $table->string('contacto')->nullable();
            $table->bigInteger('forma_pago_id');
            $table->tinyInteger('activo')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
