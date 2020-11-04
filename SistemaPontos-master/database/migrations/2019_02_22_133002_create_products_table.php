<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration{

    public function up(){
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('points_required', 13,2)->nullable();
            $table->string('qt_stock')->nullable();
            $table->integer('status');

            $table->timestamps();
        });

        Schema::create('gallery_products', function (Blueprint $table) {

            $table->increments('id');
            $table->string('url_img');
            $table->integer('id_product')->unsigned();

            $table->foreign('id_product')
            ->references('id')
            ->on('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(){

        Schema::dropIfExists('products');
    }
}
