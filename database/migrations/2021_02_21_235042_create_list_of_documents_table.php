<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListOfDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_of_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_no');
            $table->string('document_title');
            $table->string('document_category');
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
        Schema::dropIfExists('list_of_documents');
    }
}
