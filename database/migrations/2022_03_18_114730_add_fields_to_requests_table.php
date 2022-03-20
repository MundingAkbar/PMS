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
        Schema::table('requests', function (Blueprint $table) {
            //
            $table->date('effective_date')->nullable();
            $table->date('date_of_request')->nullable();
            $table->bigInteger('office')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->string('nature_of_request')->nullable();
            $table->string('replaced_parts')->nullable();
            $table->string('amount_of_replaced_parts');
            $table->bigInteger('requested_by')->unsigned()->nullable();
            $table->bigInteger('assigned_personnel')->unsigned()->nullable();
            $table->date('date_received')->nullable();
            $table->string('findings')->nullable();
            $table->string('status')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('recommending_for')->nullable();
            $table->bigInteger('date_returned_by')->unsigned()->nullable();
            $table->bigInteger('accepted_by')->unsigned()->nullable();

            $table->foreign('office')->references('id')->on('offices')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('requested_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('assigned_personnel')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('date_returned_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('accepted_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            //
        });
    }
};
