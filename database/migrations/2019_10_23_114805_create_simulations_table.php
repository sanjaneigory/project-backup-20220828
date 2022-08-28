<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('simulations');
        Schema::create('simulations', function (Blueprint $table) {
            $table->increments('sim_id');
            $table->integer('subscriber_id')->unsigned();
            $table->integer('riskcriteria_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('sim_bank_acc_no');
            $table->float('sim_bank_bal_1',10,2);
            $table->float('sim_bank_bal_2',10,2);
            $table->float('sim_bank_bal_3',10,2);
            $table->string('sim_overide')->default(0);
            $table->string('sim_status')->default('Pending');
            $table->string('sim_result')->default('Empty');
            $table->string('sim_recommendation')->default('None');
            $table->timestamps();

        });

        Schema::table('simulations', function (Blueprint $table) {
            $table->foreign('subscriber_id')->references('sub_id')->on('subscribers')->onDelete('cascade');
            $table->foreign('riskcriteria_id')->references('rc_id')->on('riskcriterias')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('simulations');
    }
}
