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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->bigInteger('ciente_id')->unsigned();
            $table->bigInteger('obra_id')->unsigned();
            $table->bigInteger('forma_pago_id')->unsigned();
            $table->bigInteger('user_ret_id')->unsigned();
            $table->boolean('retirado')->default(false);
            $table->bigInteger('user_aut_id')->unsigned();
            $table->bigInteger('factura')->unsigned();
            $table->bigInteger('estado_id')->default(1);
            $table->boolean('autorizado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
