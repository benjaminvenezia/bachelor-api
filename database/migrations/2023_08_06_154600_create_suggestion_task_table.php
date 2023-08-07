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
        Schema::create('suggestion_task', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('suggestion_id');
            $table->foreign('suggestion_id')
                ->references('id')
                ->on('default_suggestions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestion_task');
    }
};
