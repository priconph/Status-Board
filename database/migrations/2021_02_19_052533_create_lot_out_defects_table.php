<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotOutDefectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_out_defects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_name');
            $table->string('mode_of_defect');
            $table->string('contributing_line');
            $table->string('date_detected'); 
            $table->string('imagefilename');
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
        Schema::dropIfExists('lot_out_defects');
    }
}
