<?php

use App\Constants\Authorization\AccessGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('group');
            $table->timestamps();
        });

        DB::table('auth_accesses')->insert([
            ['name' => 'All', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Add', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Edit', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Delete', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Service List', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Service Add', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Service Edit', 'group' => AccessGroup::DEPARTMENT],
            ['name' => 'Service Delete', 'group' => AccessGroup::DEPARTMENT],

            ['name' => 'All', 'group' => AccessGroup::EMPLOYEE],
            ['name' => 'Add', 'group' => AccessGroup::EMPLOYEE],
            ['name' => 'Edit', 'group' => AccessGroup::EMPLOYEE],
            ['name' => 'Deactive', 'group' => AccessGroup::EMPLOYEE],
            ['name' => 'Profile', 'group' => AccessGroup::EMPLOYEE],

            ['name' => 'All', 'group' => AccessGroup::FEEDBACK],

            ['name' => 'All', 'group' => AccessGroup::CLIENT],
            ['name' => 'Add', 'group' => AccessGroup::CLIENT],
            ['name' => 'Edit', 'group' => AccessGroup::CLIENT],
            ['name' => 'Delete', 'group' => AccessGroup::CLIENT],
            ['name' => 'Enroll', 'group' => AccessGroup::CLIENT],

            ['name' => 'View', 'group' => AccessGroup::REQUEST],
            ['name' => 'Approve', 'group' => AccessGroup::REQUEST],
            ['name' => 'Deny', 'group' => AccessGroup::REQUEST],

            ['name' => 'All', 'group' => AccessGroup::TASK],

            ['name' => 'All', 'group' => AccessGroup::PROJECT],
            ['name' => 'Add', 'group' => AccessGroup::PROJECT],
            ['name' => 'Edit', 'group' => AccessGroup::PROJECT],
            ['name' => 'Remove', 'group' => AccessGroup::PROJECT],
            ['name' => 'Cancel', 'group' => AccessGroup::PROJECT],
            ['name' => 'Overview', 'group' => AccessGroup::PROJECT],

            ['name' => 'Service All', 'group' => AccessGroup::PR_SERVICE],
            ['name' => 'Service Add', 'group' => AccessGroup::PR_SERVICE],
            ['name' => 'Service Edit', 'group' => AccessGroup::PR_SERVICE],
            ['name' => 'Service Delete', 'group' => AccessGroup::PR_SERVICE],

            ['name' => 'Document All', 'group' => AccessGroup::PR_DOCUMENT],
            ['name' => 'Document Add', 'group' => AccessGroup::PR_DOCUMENT],
            ['name' => 'Document Edit', 'group' => AccessGroup::PR_DOCUMENT],
            ['name' => 'Document Delete', 'group' => AccessGroup::PR_DOCUMENT],

            ['name' => 'Team All', 'group' => AccessGroup::PR_TEAM],
            ['name' => 'Team Assign Member', 'group' => AccessGroup::PR_TEAM],
            ['name' => 'Team Activities', 'group' => AccessGroup::PR_TEAM],
            ['name' => 'Team Remove', 'group' => AccessGroup::PR_TEAM],

            ['name' => 'View', 'group' => AccessGroup::PR_ACTIVITIES],

            ['name' => 'All', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Add', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Edit', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Delete', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Request All', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Request Add', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Request Edit', 'group' => AccessGroup::PR_ACCESS],
            ['name' => 'Request Delete', 'group' => AccessGroup::PR_ACCESS],

            ['name' => 'List & Table All', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Calender View', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Activities', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Task Add', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Sub Task Add', 'group' => AccessGroup::PR_TASK],
            ['name' => 'New Assign Member', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Convert To Sub Task', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Duplicate', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Archive', 'group' => AccessGroup::PR_TASK],
            ['name' => 'Delete', 'group' => AccessGroup::PR_TASK],

            ['name' => 'Description', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Comment Add', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Comment View', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Details', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Details Add Field', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Details  Remove', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Attachment', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Attachment Add', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Attachment Remove', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Actions Item', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'In Review', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],
            ['name' => 'Submit', 'group' => AccessGroup::PR_TASK_DETAILS_VIEW],

            ['name' => 'All', 'group' => AccessGroup::PR_INTEGRATION_CONFIGURATION],
            ['name' => 'Add', 'group' => AccessGroup::PR_INTEGRATION_CONFIGURATION],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
    }
}
