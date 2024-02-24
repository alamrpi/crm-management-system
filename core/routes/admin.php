<?php

use App\Http\Controllers\Admin\Project\IntegrationConfigController;
use App\Utility\AuthHelper;
use Illuminate\Support\Facades\Route;
use App\Constants\Authorization\Access;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MyAccountController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\Project\TeamController;
use App\Http\Controllers\Admin\Project\ProjectController;
use App\Http\Controllers\Admin\TimeAndActivityController;
use App\Http\Controllers\Admin\Project\ProjectTaskController;
use App\Http\Controllers\Admin\Project\ProjectAccessController;
use App\Http\Controllers\Admin\Project\ProjectActivityController;
use App\Http\Controllers\Admin\Project\ProjectDocumentController;
use App\Http\Controllers\Admin\Project\Task\TaskActionsController;
use App\Http\Controllers\Admin\Project\Task\TaskDetailsController;
use App\Http\Controllers\Admin\Project\Task\TaskCommentsController;
use App\Http\Controllers\Admin\Project\Task\TaskAttachmentsController;
use App\Http\Controllers\Admin\Project\Task\TaskMemberAssignController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/admin/project/{id}/service/{department_id}/get-by-department', [ProjectController::class, 'getServicesByDepartment'])->name('admin/project/service/getByDepartment');

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function (){

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('/', [DashboardController::class, 'index'])->name('admin/dashboard');
        Route::get('/get-projects', [DashboardController::class, 'getProjectsbyStatus'])->name('admin/dashboard/getProjects');
        Route::get('/over-due-tasks', [DashboardController::class, 'overDueTasks'])->name('admin/dashboard/overDueTasks');
        Route::get('/next-due-tasks', [DashboardController::class, 'nextDueTasks'])->name('admin/dashboard/nextDueTasks');
        Route::get('/today-due-tasks', [DashboardController::class, 'todayDueTasks'])->name('admin/dashboard/todayDueTasks');
        Route::get('/project-tasks-chart', [DashboardController::class, 'projectTasksChart'])->name('admin/dashboard/projectTasksChart');
        Route::get('/check-time-tracker/{user_id}',[ProjectTaskController::class, 'checkTimeTracker'] )->name('admin/check-time-tracker');
        Route::get('/project-status-chart/{projectId}', [ProjectController::class, 'projectStatusChart'])->name('admin/dashboard/projectStatusChart');
        Route::get('/next-day-tasks/{userId}', [DashboardController::class, 'nextDayTasks'])->name('admin/dashboard/next-day-tasks');
    });

    Route::group(['prefix' => 'project'], function (){

        Route::get('/index', [ProjectController::class, 'index'])->name('admin/project/index')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ALL));
        Route::get('/create', [ProjectController::class, 'create'])->name('admin/project/create')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ADD));
        Route::post('/store', [ProjectController::class, 'store'])->name('admin/project/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ADD));

        Route::get('/create/{id}/purchase-service', [ProjectController::class, 'next'])->name('admin/project/service/next');
        Route::get('/create/{id}/purchase-service/edit/{purchase_id}', [ProjectController::class, 'nextEdit'])->name('admin/project/service/next/edit');
        Route::post('/create/{id}/purchase-service/update', [ProjectController::class, 'nextUpdate'])->name('admin/project/service/next/update');
        Route::post('/create/{id}/store-service', [ProjectController::class, 'storeService'])->name('admin/project/store-service');
        Route::get('/create/{id}/service/{service_id}/delete', [ProjectController::class, 'deleteService'])->name('admin/project/service/delete');

        Route::get('/project-by-member', [ProjectController::class, 'ProjectByMember'])->name('admin/project/project-by-member');

        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('admin/project/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_EDIT));
        Route::post('/{id}/update', [ProjectController::class, 'update'])->name('admin/project/update')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_EDIT));

        Route::get('/{id}/status', [ProjectController::class, 'getStatus'])->name('admin/project/status')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_EDIT));
        Route::post('/{id}/status', [ProjectController::class, 'updateStatus'])->name('admin/project/status')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_EDIT));

        Route::post('/{id}/cancel', [ProjectController::class, 'cancel'])->name('admin/project/cancel')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_CANCEL));
        Route::post('/{id}/remove', [ProjectController::class, 'remove'])->name('admin/project/remove')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_REMOVE));
        Route::get('/{id}/overview', [ProjectController::class, 'overview'])->name('admin/project/overview')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_OVERVIEW));

        Route::get('/{id}/document/index', [ProjectDocumentController::class, 'index'])->name('admin/project/document/index')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_ALL));
        Route::get('/{id}/document/create', [ProjectDocumentController::class, 'create'])->name('admin/project/document/create')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_ADD));
        Route::post('/{id}/document/store', [ProjectDocumentController::class, 'store'])->name('admin/project/document/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_ADD));
        Route::get('/{id}/document/{document_id}/edit', [ProjectDocumentController::class, 'edit'])->name('admin/project/document/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_EDIT));
        Route::post('/{id}/document/{document_id}/update', [ProjectDocumentController::class, 'update'])->name('admin/project/document/update')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_EDIT));
        Route::get('/{id}/document/{document_id}/delete', [ProjectDocumentController::class, 'delete'])->name('admin/project/document/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_DOCUMENT_DELETE));


        Route::get('/{id}/activity/index', [ProjectActivityController::class, 'index'])->name('admin/project/activity/index')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACTIVITIES_VIEW));
        Route::get('/{id}/service/grid', [ProjectController::class, 'serviceGridView'])->name('admin/project/service/gridView')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_SERVICE_ALL));
        Route::get('/{id}/service/table', [ProjectController::class, 'serviceTableView'])->name('admin/project/service/tableView')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_SERVICE_ALL));

        //Route::get('/{id}/service/{department_id}/get-by-department', [ProjectController::class, 'getServicesByDepartment'])->name('admin/project/service/getByDepartment');


        Route::prefix('/{id}/tasks')->group(function (){
            Route::get('/', [ProjectTaskController::class, 'index'])->name('admin/project/task/index')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ALL));
            /***** for ajax call start *****/
            Route::get('/tasks-by-project', [ProjectTaskController::class, 'taskByProject'])->name('admin/project/task/task-by-project');
            /***** for ajax call end *****/
            Route::get('/create', [ProjectTaskController::class, 'create'])->name('admin/project/task/create')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ADD));
            Route::post('/store', [ProjectTaskController::class, 'store'])->name('admin/project/task/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ADD));
            Route::get('/calendar/filter/{task_status}/{task_date}', [ProjectTaskController::class, 'calendarViewFilter'])->name('admin/project/task/calendar-view-filter')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_CALENDER));
            Route::get('/activity', [ProjectTaskController::class, 'activity'])->name('admin/project/task/activity')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ACTIVITIES));
            Route::get('/{task_id}/edit', [ProjectTaskController::class, 'edit'])->name('admin/project/task/edit');
            Route::post('/{task_id}/update', [ProjectTaskController::class, 'update'])->name('admin/project/task/update');
            Route::post('/{task_id}/change-status', [ProjectTaskController::class, 'changeStatus'])->name('admin/project/task/change-status');
            Route::get('/{task_id}/convert-task', [ProjectTaskController::class, 'convertTask'])->name('admin/project/task/convert-task');
            Route::post('/{task_id}/convert-task', [ProjectTaskController::class, 'convertTaskStore'])->name('admin/project/task/convert-task-store');
            Route::get('/{task_id}/get-working-hour', [ProjectTaskController::class, 'getWorkingHours'])->name('admin/project/task/working-hour-modal');
            Route::get('/{task_id}/edit-tracker', [ProjectTaskController::class, 'editTracker'])->name('admin/project/task/edit-tracker');
            Route::post('/{task_id}/update-tracker', [ProjectTaskController::class, 'updateTracker'])->name('admin/project/task/update-tracker');
            Route::post('/{task_id}/remove-tracker', [ProjectTaskController::class, 'removeTracker'])->name('admin/project/task/remove-tracker');
            Route::get('/{task_id}/archive-modal', [ProjectTaskController::class, 'archiveModal'])->name('admin/project/task/archiveModal');
            Route::post('/{task_id}/archive', [ProjectTaskController::class, 'archive'])->name('admin/project/task/archive')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ARCHIVE));

            Route::post('/{task_id}/approve', [ProjectTaskController::class, 'approve'])->name('admin/project/task/approve');
            Route::post('/{task_id}/change-accepted-status', [ProjectTaskController::class, 'changeAcceptanceStatus'])->name('admin/project/task/changeAcceptanceStatus');

            Route::get('/{task_id}/details', [ProjectTaskController::class, 'details'])->name('admin/project/task/details')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DETAILS));
            Route::get('/{task_id}/details/view', [ProjectTaskController::class, 'detailsView'])->name('admin/project/task/detailsView')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DETAILS));
            Route::get('/{task_id}/review-modal', [ProjectTaskController::class, 'reviewModal'])->name('admin/project/task/review');
            Route::get('/{task_id}/review/comments', [ProjectTaskController::class, 'reviewComments'])->name('admin/project/task/review/comments')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_IN_REVIEW));
            Route::get('/{task_id}/submission/comments', [ProjectTaskController::class, 'submissionComments'])->name('admin/project/task/submission/comments')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_SUBMIT));
            Route::get('/{task_id}/submission-modal', [ProjectTaskController::class, 'SubmissionModal'])->name('admin/project/task/submission');

            Route::get('/{task_id}/sub-task', [ProjectTaskController::class, 'getSubtask'])->name('admin/project/task/sub-task');
            Route::get('/{task_id}/activities', [ProjectTaskController::class, 'getActivities'])->name('admin/project/task/activities');

            Route::post('/{task_id}/change-name', [ProjectTaskController::class, 'changeName'])->name('admin/project/task/change-name');
            Route::post('/{task_id}/start-timer', [ProjectTaskController::class, 'startTimer'])->name('admin/project/task/start-timer');
            Route::post('/{task_id}/stop-timer', [ProjectTaskController::class, 'stopTimer'])->name('admin/project/task/stop-timer');
            Route::post('/{task_id}/add-hour', [ProjectTaskController::class, 'addHour'])->name('admin/project/task/add-tracking-hour');
            Route::post('/{task_id}/save-description', [ProjectTaskController::class, 'saveDescription'])->name('admin/project/task/save-description')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DESCRIPTION));
            Route::post('/{task_id}/save-manual-tracking', [ProjectTaskController::class, 'saveManualTracking'])->name('admin/project/task/save-manual-tracking')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DESCRIPTION));

            Route::post('/{task_id}/change-details-label', [TaskDetailsController::class, 'changeLabelName'])->name('admin/project/task/change-detail-label');
            Route::post('/{task_id}/save-details', [TaskDetailsController::class, 'store'])->name('admin/project/task/save-details')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DETAILS_ADD));
            Route::post('/{task_id}/delete-details', [TaskDetailsController::class, 'delete'])->name('admin/project/task/save-delete')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_DETAILS_REMOVE));

            Route::get('/{task_id}/attachments', [TaskAttachmentsController::class, 'gets'])->name('admin/project/task/attachments')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ATTACHMENT));
            Route::post('/{task_id}/attachments/store', [TaskAttachmentsController::class, 'store'])->name('admin/project/task/attachments/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ATTACHMENT_ADD));
            Route::post('/{task_id}/attachment/delete', [TaskAttachmentsController::class, 'delete'])->name('admin/project/task/attachment/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ATTACHMENT_REMOVE));

            Route::get('/{task_id}/comments', [TaskCommentsController::class, 'gets'])->name('admin/project/task/comments')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_COMMENT_VIEW));
            Route::post('/{task_id}/store', [TaskCommentsController::class, 'store'])->name('admin/project/task/comments/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_COMMENT_ADD));

            Route::get('/{task_id}/assign-member', [TaskMemberAssignController::class, 'create'])->name('admin/project/task/assignMember')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ASSIGN));
            Route::get('/{task_id}/edit-assign-member/{assign_to_id}', [TaskMemberAssignController::class, 'edit'])->name('admin/project/task/assignMember/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ASSIGN));

            Route::post('/{task_id}/update-assign-member/', [TaskMemberAssignController::class, 'update'])->name('admin/project/task/assignMember/update')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ASSIGN));
            Route::post('/{task_id}/remove-assign-member/{assign_to_id}', [TaskMemberAssignController::class, 'delete'])->name('admin/project/task/assignMember/remove')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ASSIGN));

            Route::post('/{task_id}/store-assign-member', [TaskMemberAssignController::class, 'store'])->name('admin/project/task/assignMember/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TASK_ASSIGN));

            Route::get('/{task_id}/action-items', [TaskActionsController::class, 'gets'])->name('admin/project/task/action-items');
            Route::get('/{task_id}/action-items/add', [TaskActionsController::class, 'create'])->name('admin/project/task/action-items/add');
            Route::post('/{task_id}/action-items/store', [TaskActionsController::class, 'store'])->name('admin/project/task/action-items/store');
            Route::post('/{task_id}/action-items/rename', [TaskActionsController::class, 'rename'])->name('admin/project/task/action-items/rename');
            Route::post('/{task_id}/action-items/insert-item', [TaskActionsController::class, 'insertItem'])->name('admin/project/task/action-items/insertItem');
            Route::post('/{task_id}/action-items/checked', [TaskActionsController::class, 'changeCheckStatus'])->name('admin/project/task/action-items/changeCheckStatus');
            Route::post('/{task_id}/action-items/update-item', [TaskActionsController::class, 'updateItem'])->name('admin/project/task/action-items/updateItem');
            Route::post('/{task_id}/action-items/remove-item', [TaskActionsController::class, 'removeItem'])->name('admin/project/task/action-items/removeItem');
            Route::post('/{task_id}/action-items/remove', [TaskActionsController::class, 'remove'])->name('admin/project/task/action-items/remove');

        });
        Route::get('/{id}/team/index', [TeamController::class, 'team'])->name('admin/project/team/index');
        Route::post('/{id}/team/assign-member', [TeamController::class, 'assignMember'])->name('admin/project/team/assign-member')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TEAM_ASSIGN_MEMBER));
        Route::delete('/{id}/team/remove-member/{access_id}', [TeamController::class, 'removeMember'])->name('admin/project/team/remove-member')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_TEAM_REMOVE));
        Route::get('/{id}/getMemberByDepartmentId', [TeamController::class, 'getMemberByDepartmentId'])->name('admin/project/team/getMemberByDepartmentId');


        Route::get('/{id}/access/index', [ProjectAccessController::class, 'index'])->name('admin/project/access/index')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_ALL));
        Route::post('/{id}/access/store', [ProjectAccessController::class, 'store'])->name('admin/project/access/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_ADD));
        Route::get('/{id}/access/{access_id}/edit', [ProjectAccessController::class, 'edit'])->name('admin/project/access/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_EDIT));
        Route::post('/{id}/access/{access_id}/update', [ProjectAccessController::class, 'update'])->name('admin/project/access/update')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_EDIT));
        Route::get('/{id}/access/{access_id}/delete', [ProjectAccessController::class, 'delete'])->name('admin/project/access/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_DELETE));

        Route::post('/{id}/access-request/store', [ProjectAccessController::class, 'requestStore'])->name('admin/project/accessRequest/store')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_REQUEST_ADD));
        Route::post('/{id}/access-request/{request_id}/update', [ProjectAccessController::class, 'requestUpdate'])->name('admin/project/accessRequest/update')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_REQUEST_EDIT));
        Route::get('/{id}/access-request/{request_id}/delete', [ProjectAccessController::class, 'requestDelete'])->name('admin/project/accessRequest/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::PR_ACCESS_REQUEST_DELETE));

        Route::get('/{id}/integration-config/keyword/index', [IntegrationConfigController::class, 'index'])->name('admin/project/integrationConfig/keyword/index');
        Route::post('/{id}/integration-config/keyword/store', [IntegrationConfigController::class, 'store'])->name('admin/project/integrationConfig/keyword/store');
        Route::post('/{id}/integration-config/keyword/{cid}/update', [IntegrationConfigController::class, 'update'])->name('admin/project/integrationConfig/keyword/update');
        Route::get('/{id}/integration-config/keyword/{cid}/website', [IntegrationConfigController::class, 'keywordWebsite'])->name('admin/project/integrationConfig/keyword/keywordWebsite');
        Route::post('/{id}/integration-config/keyword/{cid}/keyword/addorUpdate', [IntegrationConfigController::class, 'keywordAddOrUpdate'])->name('admin/project/integrationConfig/keyword/addOrUpdate');
        Route::get('/{id}/integration-config/keyword/{cid}/keyword/{keyword_id}/delete', [IntegrationConfigController::class, 'keywordDelete'])->name('admin/project/integrationConfig/keyword/keyword/delete');
        Route::get('/{id}/integration-config/keyword/{cid}/keywords', [IntegrationConfigController::class, 'keywords'])->name('admin/project/integrationConfig/keyword/keywords');
        Route::get('/{id}/integration-config/keyword/{cid}/id-and-key', [IntegrationConfigController::class, 'keywordIDKey'])->name('admin/project/integrationConfig/keyword/keywordIDKey');
        Route::post('/{id}/integration-config/keyword/{cid}/update-id-key', [IntegrationConfigController::class, 'updateIdKey'])->name('admin/project/integrationConfig/keyword/updateIdKey');
    });

    Route::get('/feedbacks', [DashboardController::class, 'feedbacks'])->name('admin/feedbacks')->middleware(AuthHelper::checkAuthAccess((string)Access::FEEDBACK_ALL));

    Route::get('/tasks', [DashboardController::class, 'tasks'])->name('admin/tasks');
    Route::get('/tasks/calender', [DashboardController::class, 'tasksCalendar'])->name('admin/tasks/calendar');

    Route::get('/request/index', [DashboardController::class, 'requests'])->name('admin/request/index')->middleware(AuthHelper::checkAuthAccess((string)Access::REQUEST_VIEW));
    Route::get('/request/{id}/details', [DashboardController::class, 'requestDetails'])->name('admin/request/details')->middleware(AuthHelper::checkAuthAccess((string)Access::REQUEST_VIEW));

    Route::group(['prefix' => 'client'], function (){
        Route::get('/index', [ClientController::class, 'index'])->name('admin/client/index')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ALL));
        Route::get('/create', [ClientController::class, 'create'])->name('admin/client/create')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ADD));
        Route::post('/store', [ClientController::class, 'store'])->name('admin/client/store')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ADD));
        Route::get('/enroll', [ClientController::class, 'enroll'])->name('admin/client/enroll')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ENROLL));
        Route::post('/get-info', [ClientController::class, 'getInfo'])->name('admin/client/getInfo')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ALL));
        Route::get('/{id}/enroll', [ClientController::class, 'enrollStore'])->name('admin/client/enrollStore')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_ENROLL));
        Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('admin/client/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_EDIT));
        Route::post('/{id}/update', [ClientController::class, 'update'])->name('admin/client/update')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_EDIT));
        Route::get('/{id}/delete', [ClientController::class, 'delete'])->name('admin/client/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::CLIENT_DELETE));
    });

    Route::group(['prefix' => 'department'], function (){
        Route::get('/index', [DepartmentController::class, 'index'])->name('admin/department/index')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_ALL));

        Route::get('/create', [DepartmentController::class, 'create'])->name('admin/department/create')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_ADD));
        Route::post('/store', [DepartmentController::class, 'store'])->name('admin/department/store')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_ADD));
        Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('admin/department/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_EDIT));
        Route::post('/{id}/update', [DepartmentController::class, 'update'])->name('admin/department/update')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_EDIT));
        Route::get('/{id}/delete', [DepartmentController::class, 'delete'])->name('admin/department/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_DELETE));
        Route::group(['prefix'=>'service'], function (){
            Route::get('/index', [ServiceController::class, 'index'])->name('admin/department/service/index')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_LIST));
            Route::get('/create', [ServiceController::class, 'create'])->name('admin/department/service/create')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_ADD));
            Route::post('/store', [ServiceController::class, 'store'])->name('admin/department/service/store')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_ADD));
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('admin/department/service/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_EDIT));
            Route::post('/{id}/update', [ServiceController::class, 'update'])->name('admin/department/service/update')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_EDIT));
            Route::get('/{id}/delete', [ServiceController::class, 'delete'])->name('admin/department/service/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::DEPT_SERVICE_DELETE));

            //Routes for ajax call
            Route::post('/gets-for-ddl', [ServiceController::class, 'getForDdl'])->name('admin/department/service/getsForDdl');
        });
    });

    Route::prefix('roles')->group(function (){
        Route::get('/index',[RoleController::class, 'index'])->name('admin/role/index');
        Route::get('/create',[RoleController::class, 'create'])->name('admin/role/create');
        Route::post('/store',[RoleController::class, 'store'])->name('admin/role/store');
        Route::get('/{id}/edit',[RoleController::class, 'edit'])->name('admin/role/edit');
        Route::post('/{id}/update',[RoleController::class, 'update'])->name('admin/role/update');
        Route::get('/{id}/delete',[RoleController::class, 'delete'])->name('admin/role/delete');

        Route::get('/{id}/assign-access',[RoleController::class, 'assignAccess'])->name('admin/role/assign-access');
        Route::post('/{id}/assign-access/store',[RoleController::class, 'assignAccessStore'])->name('admin/role/assign-access/store');
    });

    Route::get('/index',[RoleController::class, 'index'])->name('admin/role/index');
    Route::get('/create',[RoleController::class, 'create'])->name('admin/role/create');
    Route::post('/store',[RoleController::class, 'store'])->name('admin/role/store');
    Route::get('/{id}/edit',[RoleController::class, 'edit'])->name('admin/role/edit');
    Route::post('/{id}/update',[RoleController::class, 'update'])->name('admin/role/update');
    Route::get('/{id}/delete',[RoleController::class, 'delete'])->name('admin/role/delete');

    Route::group(['prefix' => 'users'], function (){
        Route::get('/index',[UserController::class, 'index'])->name('admin/users/index');
        Route::get('/{user_id}/activation-toggle',[UserController::class, 'ActivationToggle'])->name('admin/users/ActivationToggle');
        Route::get('/{user_id}/permissions',[UserController::class, 'permissions'])->name('admin/users/permissions');
        Route::post('/{user_id}/permissions/save-changes',[UserController::class, 'permissionsSaveChanges'])->name('admin/users/permissions/saveChanges');
    });


    Route::group(['prefix' => 'employee'], function (){
        Route::get('/index', [EmployeeController::class, 'index'])->name('admin/employee/index')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_ALL));
        Route::get('/create', [EmployeeController::class, 'create'])->name('admin/employee/create')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_ADD));
        Route::post('/store', [EmployeeController::class, 'store'])->name('admin/employee/store')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_ADD));
        Route::get('/{id}/profile', [EmployeeController::class, 'details'])->name('admin/employee/details')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_PROFILE));
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('admin/employee/edit')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_EDIT));
        Route::post('/{id}/update', [EmployeeController::class, 'update'])->name('admin/employee/update')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_EDIT));
        Route::get('/{id}/delete', [EmployeeController::class, 'delete'])->name('admin/employee/delete')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_DEACTIVE));
        Route::get('/{id}/deactive', [EmployeeController::class, 'deactive'])->name('admin/employee/deactive')->middleware(AuthHelper::checkAuthAccess((string)Access::EMPLOYEE_DEACTIVE));
    });

    Route::get('/my-profile', [MyAccountController::class, 'myProfile'])->name('admin/myProfile');
    Route::put('/my-profile', [MyAccountController::class, 'updateMyProfile'])->name('admin/myProfile/store');

    Route::get('/my-agency', [MyAccountController::class, 'myAgency'])->name('admin/myAgency');

    Route::get('/change-password', [MyAccountController::class, 'changePassword'])->name('admin/changePassword');
    Route::post('/change-password', [MyAccountController::class, 'updateChangePassword'])->name('admin/changePassword/update');

    Route::get('/social-links', [MyAccountController::class, 'socialLinks'])->name('admin/socialLinks');
    Route::post('/store-social-links', [MyAccountController::class, 'storeSocialLinks'])->name('admin/socialLinks/store');
    Route::get('/{media_id}/delete-social-links', [MyAccountController::class, 'deleteSocialLinks'])->name('admin/socialLinks/delete');
    Route::get('/cv', [MyAccountController::class, 'cv'])->name('admin/cv');
    Route::post('/cv/store', [MyAccountController::class, 'storeCv'])->name('admin/cv/store');
    Route::get('/cv/{cv_id}/delete', [MyAccountController::class, 'deleteCv'])->name('admin/cv/delete');

    Route::get('/notes/index', [DashboardController::class, 'notes'])->name('admin/notes/index');

    Route::group(['prefix'=> 'time-activity'], function(){
        Route::get('/index', [TimeAndActivityController::class, 'index'])->name('admin/time-and-activity/index');
    });

});
