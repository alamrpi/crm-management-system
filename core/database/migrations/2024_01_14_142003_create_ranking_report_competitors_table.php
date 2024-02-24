<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingReportCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_report_competitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ranking_report_id');
            $table->string('competitor_name');
            $table->integer('common_keyword');
            $table->foreign('ranking_report_id')->references('id')->on('ranking_reports')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_report_competitors');
    }
}
