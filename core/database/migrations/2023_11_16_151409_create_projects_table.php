<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('client_id');
            $table->string('project_name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->tinyInteger('priority')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->date('deadline');
            $table->date('target');
            $table->string('thumbnail');
            $table->tinyInteger('entry_complete')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
