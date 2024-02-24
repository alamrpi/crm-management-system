<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('project_id');
            $table->string('task_name');
            $table->string('task_id');
            $table->date('due_date');
            $table->tinyInteger('priority')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('in_review')->default(0);
            $table->tinyInteger('completed_status')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('task_type');
            $table->string('details_field_name')->default('Custom Fields');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('accepted_time')->nullable();
            $table->dateTime('review_time')->nullable();
            $table->dateTime('approved_time')->nullable();
            $table->dateTime('completed_time')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists('tasks');
    }
}
