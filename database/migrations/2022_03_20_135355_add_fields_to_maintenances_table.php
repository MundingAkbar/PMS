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
        Schema::table('maintenances', function (Blueprint $table) {
            //
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('working_days')->nullable();
            $table->integer('units')->nullable();
            $table->bigInteger('office')->unsigned()->nullable();

            $table->foreign('office')->references('id')->on('offices')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            //
        });
    }
};
