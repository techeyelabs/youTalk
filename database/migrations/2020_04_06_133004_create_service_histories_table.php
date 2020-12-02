<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('receiver_id');
            $table->unsignedInteger('seconds');
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('providers_cut');
            $table->unsignedInteger('systems_cut');
            $table->unsignedInteger('payment_type');
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
        Schema::dropIfExists('service_histories');
    }
}
