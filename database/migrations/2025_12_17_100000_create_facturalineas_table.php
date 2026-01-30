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
        Schema::create('facturalineas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_factura');
            $table->integer('codigo')->nullable();
            $table->decimal('cantidad', 10, 2)->default(0);
            $table->string('descripcion', 50)->nullable();
            $table->decimal('precio', 10, 2)->default(0);
            $table->decimal('base', 19, 2)->default(0);
            $table->decimal('iva', 5, 2)->default(0);
            $table->decimal('importeiva', 19, 2)->default(0);
            $table->decimal('importe', 19, 2)->default(0);
            $table->timestamps();

            $table->foreign('id_factura')->references('id')->on('facturas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturalineas');
    }
};
