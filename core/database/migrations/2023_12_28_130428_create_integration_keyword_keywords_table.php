<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrationKeywordKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integration_keyword_keywords', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('integration_keyword_id');
            $table->string('keyword_name');
            $table->foreign('integration_keyword_id')->references('id')->on('integration_keywords')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integration_keyword_keywords');
    }
}
