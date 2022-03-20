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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('property_number')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('units')->nullable();
            $table->decimal('unit_value', 15, 2)->nullable();
            $table->decimal('total_value', 15, 2)->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('article')->unsigned()->nullable();
            $table->bigInteger('requisitioner')->unsigned()->nullable();
            $table->bigInteger('deployment')->unsigned()->nullable();
            
            $table->foreign('article')->references('id')->on('articles')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('requisitioner')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('deployment')->references('id')->on('offices')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('vehicles');
    }
};
