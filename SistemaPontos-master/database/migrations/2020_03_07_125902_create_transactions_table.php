<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration{

    public function up(){

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');

            $table->string('plate')->nullable();

            $table->integer('id_plan')->unsigned();
            $table->integer('id_send')->unsigned();
            $table->integer('id_receive')->unsigned();

            $table->decimal('points', 13,2);
            $table->integer('status')->default(0);

            $table->foreign('id_plan')
            ->references('id')
            ->on('plans')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_receive')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('obs')->nullable();
            $table->timestamps();
        });

    }

    public function down(){
        Schema::drop('transactions');
    }
}
