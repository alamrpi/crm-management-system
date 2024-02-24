<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPSServicePerDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_ps_service_per_days', function (Blueprint $table) {
            $table->unsignedBigInteger('project_ps_id')->primary();
            $table->double('hour');
            $table->integer('number_of_employee');
            $table->integer('working_day');
            $table->timestamps();
            $table->foreign('project_ps_id')->references('id')->on('project_purchase_services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_p_s_service_per_days');
    }
}
