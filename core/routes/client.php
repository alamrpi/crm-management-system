<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\KeywordRankingReportController;
use App\Http\Controllers\Client\RouteManagerController;
use App\Http\Controllers\Client\WorkStatusController;

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

Route::prefix('clientarea')->name('clientarea/')->middleware(['auth'])->group(function (){

    Route::prefix('api')->name('api/')->group(function(){
        Route::get('', function(){})->name('base_url');
        Route::get('last-completed-tasks', [DashboardController::class, 'lastCompletedTasks'])->name('last-completed-tasks');
        Route::get('next-due-tasks', [DashboardController::class, 'nextDueTasks'])->name('next-due-tasks');
        Route::get('task-overview-chart', [DashboardController::class, 'taskOverviewChart'])->name('task-overview-chart');
        Route::get('project-task-status-chart', [DashboardController::class, 'projectTaskStatusChart'])->name('project-task-status');
        Route::get('project-task-hour-status', [DashboardController::class, 'projectTaskHourStatusChart'])->name('project-task-hour-status');
    });

    Route::get('/welcome', [DashboardController::class, 'welcome'])->name('welcome');
        Route::get('/switch-project', [DashboardController::class, 'switchProject'])->name('switchProject');

    Route::get('chat', [DashboardController::class, 'chat'])->name('chat');

    Route::prefix('project')->name('project/')->group(function(){
        Route::prefix('{slug?}')->group(function(){
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            Route::get('team', [DashboardController::class, 'team'])->name('team');
            Route::get('team/profile/{id?}', [DashboardController::class, 'teamMemberProfile'])->name('team/profile');
            Route::get('team/{id}/profile', [DashboardController::class, 'teamProfile'])->name('clientarea/profile');
          
            Route::get('report/integrated-report', [DashboardController::class, 'integratedReport'])->name('report/integratedReport');
            Route::get('report/keyword-ranking-report', [KeywordRankingReportController::class, 'index'])->name('report/keywordRankingReport');
            Route::get('report/keyword-ranking-report/kewword-details', [KeywordRankingReportController::class, 'keywordDetails'])->name('report/keywordRankingReport/keywordDetails');
        
           Route::prefix('work-status')->group(function(){
                Route::get('', [DashboardController::class, 'workStatus'])->name('workStatus');
                Route::get('getTasks', [WorkStatusController::class, 'getTasks'])->name('workStatus/getTasks');
                Route::get('/{id}/task-details', [WorkStatusController::class, 'taskDetails'])->name('workStatus/taskDetails');
                Route::get('/{id}/load-Comments', [WorkStatusController::class, 'loadComments'])->name('workStatus/loadComments');
                Route::post('/{id}/store-Comments', [WorkStatusController::class, 'storeComments'])->name('workStatus/storeComments');
                Route::get('/{id}/submission-comments', [WorkStatusController::class, 'loadSubmissionComment'])->name('workStatus/loadSubmissionComment');
                Route::post('/{id}/change-acceptance-status', [WorkStatusController::class, 'changeAcceptanceStatus'])->name('workStatus/changeAcceptanceStatus');
            });
        
        });

        /**
         *  **************************************************************
         * @ThisTwoRoutesmust be declared After all Project Base routes
         * **************************************************************
         * */
        Route::get('{any}', [RouteManagerController::class, 'index'])->where('any', '.*');
        Route::get('/', [RouteManagerController::class, 'index']);
        /**********************************************************************************************************/
    });



});
