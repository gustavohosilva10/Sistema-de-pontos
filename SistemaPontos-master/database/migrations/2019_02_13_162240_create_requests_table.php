<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration{

    public function up(){
        Schema::create('requests', function (Blueprint $table) {

            $table->increments('id');
            $table->decimal('points', 13, 2)->nullable();

            $table->integer('id_request')->unsigned();

            $table->foreign('id_request')
            ->references('id')
            ->on('users');

            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('requests');
    }
}
