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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('project_no')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('lead_id');
            $table->float('budget');
            $table->string('progress');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('assign_from');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
