<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAcceptancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_acceptances', function (Blueprint $table) {
            $table->unsignedBigInteger('submission_id')->primary();
            $table->unsignedBigInteger('accepted_by');
            $table->dateTime('accepted_time');
            $table->longText('note')->nullable();
            $table->foreign('submission_id')->references('id')->on('task_submissions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_acceptances');
    }
}
