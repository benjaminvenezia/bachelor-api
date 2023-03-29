<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('description');
            $table->integer('reward');
            $table->string('path_icon_todo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_tasks');
    }
};
