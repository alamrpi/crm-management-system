<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modules\Chat\ChatController;
use App\Http\Controllers\Modules\Chat\ChatGroupController;

Route::group(['prefix'=> 'admin'], function(){
    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', [ChatController::class, 'index'])->name('admin/chat');
        Route::get('group/create/member-suggestion', [ChatGroupController::class, 'memberSuggestion'])->name('admin/chat/group/create/memberSuggestion');
        Route::get('group/chat-groups-list', [ChatGroupController::class, 'getGroupsByUserId'])->name('admin/chat/group/getGroupsByUserId');
        Route::get('group/chat-group/{id}', [ChatGroupController::class, 'getGroupById'])->name('admin/chat/group/getGroupById');
        Route::get('start/{id}/{dataType?}', [ChatController::class, 'chatRequiredData'])->name('admin/chat/start');
        Route::get('get/group/{groupId}/{messageId?}', [ChatController::class, 'getChatMessage'])->name('admin/chat/get');
        Route::get('get/history', [ChatController::class, 'getChatHistory'])->name('admin/chat/history');
        Route::post('send/', [ChatController::class, 'sendMessage'])->name('admin/chat/send');
        Route::post('group/create', [ChatGroupController::class, 'store'])->name('admin/chat/group/create');
        Route::post('new-personal-chat', [ChatGroupController::class, 'newPersonalChat'])->name('admin/chat/newPersonalChat');
    });
});
