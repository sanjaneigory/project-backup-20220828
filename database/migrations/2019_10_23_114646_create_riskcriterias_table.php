<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class dCreateRiskcriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('riskcriterias');
        Schema::create('riskcriterias', function (Blueprint $table) {
            $table->increments('rc_id')->unsigned();
            $table->boolean('has_bank_debt')->default(0);
            $table->boolean('has_extraordinary_amt')->default(0);
            $table->boolean('has_check_returned')->default(0);
            $table->string('has_something')->nullable();
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
        Schema::dropIfExists('riskcriterias');
    }
}
