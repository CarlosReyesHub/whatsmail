<?php

use App\Http\Controllers\Api\WhatsappCallbackController;
use App\Http\Controllers\Api\WhatsappMessageController;
use App\Http\Controllers\Api\WhatsappMiscController;
use Illuminate\Support\Facades\Route;


Route::prefix('whatsapp')->group(function () {
    Route::post("callback/{device_id}", [WhatsappCallbackController::class, 'callBackWhatsapp']);
    Route::post('send-message', [WhatsappMessageController::class, 'message']);
    Route::post('set-status/{device}/{status}', [WhatsappMessageController::class, 'setStatusDevice']);

    Route::prefix('chats')->group(function () {
        Route::get('/{device}', [WhatsappMessageController::class, 'getChatList']); 
        Route::get('contacts/{device}', [WhatsappMessageController::class, 'getContactList']); 
        Route::get('detail/{device}/{chatId}', [WhatsappMessageController::class, 'getChatDetails']); 
    });

    Route::prefix('misc')->group(function() {
        Route::post("read-messages/{id}", [WhatsappMiscController::class, 'readMessage']);
        Route::post("delete-message/{id}", [WhatsappMiscController::class, 'deleteForMe']);
        Route::post("delete-everyone/{id}", [WhatsappMiscController::class, 'deleteEveryOne']);
        Route::post("download-media/{id}", [WhatsappMiscController::class, 'downloadMedia']);
        Route::post("get-profile/{id}", [WhatsappMiscController::class, 'getPhotoProfile']);
        Route::post("mark-message/{id}", [WhatsappMiscController::class, 'markMessage']);
        Route::post("delete-chat/{id}", [WhatsappMiscController::class, 'deleteChats']); 
    });
});
