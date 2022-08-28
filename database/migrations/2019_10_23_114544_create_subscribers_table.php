<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::dropIfExists('subscribers');
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('sub_id')->unsigned();
            $table->string('sub_name');
            $table->string('sub_doc_id')->unique;
            $table->string('sub_vendor');
            $table->string('sub_agent');
            $table->string('sub_account_type');
            $table->string('sub_contract_no');

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
        Schema::dropIfExists('subscribers');
    }
}
