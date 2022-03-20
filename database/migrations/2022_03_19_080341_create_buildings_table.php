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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_building')->nullable();
            $table->decimal('area_acquired',15,2)->nullable();
            $table->string('location')->nullable();
            $table->string('make')->nullable();
            $table->integer('num_of_floors')->nullable();
            $table->decimal('total_floor_area',15,2)->nullable();
            $table->string('condition')->nullable();
            $table->string('current_use')->nullable();
            $table->integer('num_of_rooms')->nullable();
            $table->date('date_constructed');
            $table->string('how_acquired')->nullable();
            $table->decimal('cost',15,2)->nullable();
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
        Schema::dropIfExists('buildings');
    }
};
