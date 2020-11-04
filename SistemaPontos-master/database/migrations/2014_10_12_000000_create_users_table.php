<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{

    public function up(){

        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('type');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->string('function')->nullable();
            $table->string('location_work')->nullable();

            $table->string('cpf')->nullable();
            $table->string('bank')->nullable();
            $table->string('agency')->nullable();
            $table->string('account')->nullable();
            $table->string('account_type')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });
    }

    public function down(){
        Schema::drop('users');
    }
}
