<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddsStatusToUsersTable extends Migration {
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->default(0);
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status');
        });
    }
}
