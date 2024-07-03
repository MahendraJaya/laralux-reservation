<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('available_room')->change();
            $table->integer('capacity')->change();
            $table->integer('price')->change();


        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('available_room')->change();
            $table->string('capacity')->change();
            $table->string('price')->change();


        });
    }
};
