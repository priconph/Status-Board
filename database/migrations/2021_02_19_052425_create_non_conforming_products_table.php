<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonConformingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_conforming_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('po_number');
            $table->string('problem');
            $table->string('ptis_ng_report_number');
            $table->string('status_disposition');
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
        Schema::dropIfExists('non_conforming_products');
    }
}
