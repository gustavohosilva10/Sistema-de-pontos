<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration{

    public function up(){

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('balance', 13,2)->default(0);
            $table->integer('id_owner')->unsigned();

            $table->foreign('id_owner')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });

    }

    public function down(){
        Schema::drop('accounts');
    }
}
