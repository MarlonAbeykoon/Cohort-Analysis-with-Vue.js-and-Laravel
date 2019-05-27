<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer', function (Blueprint $table) {
             $table->integer('user_id');
             $table->string('created_at');
             $table->integer('onboarding_perentage');
             $table->integer('count_applications');
             $table->integer('count_accepted_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumer');
    }
}
