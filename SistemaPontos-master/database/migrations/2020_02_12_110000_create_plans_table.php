<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration{

    public function up(){

        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->decimal('points', 13,2)->nullable();

            $table->integer('id_adesion')->unsigned();
            $table->foreign('id_adesion')
            ->references('id')
            ->on('adesions');

            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(){
        Schema::drop('plans');
    }
}
