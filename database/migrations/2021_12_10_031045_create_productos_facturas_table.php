<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_facturas', function (Blueprint $table) {
            $table->foreignId('producto_id')->references('id')->on('productos')->onDelete('restrict');
            $table->foreignId('factura_id')->references('id')->on('facturas')->onDelete('restrict');
            $table->smallInteger('cantidad');            
            $table->integer('subtotal')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_facturas');
    }
}
