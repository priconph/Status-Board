<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionLineEfficiencyMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_line_efficiency_monitoring', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line');
            $table->string('actual_efficiency');
            $table->string('result');
            $table->string('target');
            $table->unsignedTinyInteger('status')->default(2)->comment = '1-approved,2-unapproved';
            $table->string('date_uploaded');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('last_updated_by');             
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
        Schema::dropIfExists('production_line_efficiency_monitoring');
    }
}
