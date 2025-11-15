<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\ComponentController;
use App\Http\Controllers\Master\DirectoryController;
use App\Http\Controllers\Master\TemplateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Store\StoreScrappingController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Blash\BlashEmailController;
use App\Http\Controllers\Blash\BlashWhatsappController;
use App\Http\Controllers\ChatBot\ChatBotController;
use App\Http\Controllers\ChatBot\FineTunnelController;
use App\Http\Controllers\ComponentController as ControllersComponentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\TemplateEmailController;
use App\Http\Controllers\Media\FolderManagerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Starter\StarterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Whatsapp\SendMessageController;
use App\Http\Controllers\Whatsapp\Waba\WhatsappBroadcastController;
use App\Http\Controllers\Whatsapp\Waba\WhatsappTemplateController;
use App\Http\Controllers\Whatsapp\Waba\WhatsappWabaController;
use App\Http\Controllers\Whatsapp\WhatsappDeviceController;
use App\Http\Controllers\Whatsapp\WhatsappMiscController;

Route::get('set-lang/{code}', [SettingsController::class, 'setLang'])->name('setlang');

Route::prefix('starter')->middleware('starter_app')->group(function () {
    Route::prefix('packages')->group(function () {
        Route::get('/', [StarterController::class, 'index'])->name('starter.packages');
        Route::get('detail/{package}', [StarterController::class, 'package'])->name('starter.packages.detail');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/', [StarterController::class, 'transactions'])->name('starter.transactions');
        Route::get('detail/{transaction}', [StarterController::class, 'detail'])->name('starter.transactions.detail');
        Route::get('create/{package}', [StarterController::class, 'createTransaction'])->name('starter.transactions.create');
        Route::get("delete/{transaction}", [StarterController::class, 'delete'])->name('starter.transactions.delete');
        Route::post('pay/{transaction}', [StarterController::class, 'payTransaction'])->name('starter.transactions.pay');
    });
});

Route::middleware('package_active')->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('index');

    Route::prefix('components')->group(function () {
        Route::get('system', [ControllersComponentController::class, 'system']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('analisis', [HomeController::class, 'analiss']);
        Route::get('logs', [HomeController::class, 'logs']);
    });

    Route::prefix('master')->group(function () {

        Route::prefix('components')->group(function () {
            Route::get('provinces', [ComponentController::class, 'provinces']);
            Route::get('cities', [ComponentController::class, 'cities']);
            Route::get('districts', [ComponentController::class, 'districts']);
            Route::get('categories', [ComponentController::class, 'categories']);
            Route::get('devices', [ComponentController::class, 'devices']);
            Route::get('templates', [ComponentController::class, 'templates']);
        });

        Route::prefix('directory')->group(function () {

            Route::prefix('provinces')->group(function () {
                Route::get('/', [DirectoryController::class, 'provinces'])->name('directory.provinces');
                Route::get('create', [DirectoryController::class, 'createProvince'])->name('directory.province.create');
                Route::get('update/{province}', [DirectoryController::class, 'updateProvince'])->name('directory.province.update');
                Route::get('delete/{province}', [DirectoryController::class, 'deleteProvince'])->name('directory.province.delete');
                Route::post('store', [DirectoryController::class, 'storeProvince'])->name('directory.province.store');
                Route::post('edit/{province}', [DirectoryController::class, 'editProvince'])->name('directory.province.edit');
                Route::post('import', [DirectoryController::class, 'importProvince'])->name('directory.province.import');
            });

            Route::prefix('cities')->group(function () {
                Route::get('/', [DirectoryController::class, 'cities'])->name('directory.cities');
                Route::get('create', [DirectoryController::class, 'createCity'])->name('directory.city.create');
                Route::get('update/{city}', [DirectoryController::class, 'updateCity'])->name('directory.city.update');
                Route::get('delete/{city}', [DirectoryController::class, 'deleteCity'])->name('directory.city.delete');
                Route::post('store', [DirectoryController::class, 'storeCity'])->name('directory.city.store');
                Route::post('edit/{city}', [DirectoryController::class, 'editCity'])->name('directory.city.edit');
                Route::post('import', [DirectoryController::class, 'importCity'])->name('directory.city.import');
            });

            Route::prefix('districts')->group(function () {
                Route::get('/', [DirectoryController::class, 'districts'])->name('directory.districts');
                Route::get('create', [DirectoryController::class, 'createDistrict'])->name('directory.district.create');
                Route::get('update/{district}', [DirectoryController::class, 'updateDistrict'])->name('directory.district.update');
                Route::get('delete/{district}', [DirectoryController::class, 'deleteDistrict'])->name('directory.district.delete');
                Route::post('store', [DirectoryController::class, 'storeDistrict'])->name('directory.district.store');
                Route::post('edit/{district}', [DirectoryController::class, 'editDistrict'])->name('directory.district.edit');
                Route::post('import', [DirectoryController::class, 'importDistrict'])->name('directory.district.import');
            });

            Route::prefix('status')->group(function () {
                Route::post('province/{province}', [DirectoryController::class, 'changeProvinceStatus']);
                Route::post('city/{city}', [DirectoryController::class, 'changeCityStatus']);
            });
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
            Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('update/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
            Route::post('edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::get('delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
        });

        Route::prefix('templates')->group(function () {
            Route::get('/', [TemplateController::class, 'index'])->name('templates');
            Route::get('create', [TemplateController::class, 'create'])->name('templates.create');
            Route::get('update/{template}', [TemplateController::class, 'update'])->name('templates.update');
            Route::post('store', [TemplateController::class, 'store'])->name('templates.store');
            Route::post('edit/{template}', [TemplateController::class, 'edit'])->name('templates.edit');
            Route::delete('delete/{template}', [TemplateController::class, 'delete']);
            Route::post('delete-multiple', [TemplateController::class, 'deleteMultiple']);
            Route::get('details/{template}', [TemplateController::class, 'details']);
        });

        Route::prefix('email-template')->group(function () {
            Route::get('/', [TemplateEmailController::class, 'index'])->name('templatemail');
            Route::get('create', [TemplateEmailController::class, 'create'])->name('templatemail.create');
            Route::get('update/{template}', [TemplateEmailController::class, 'update'])->name('templatemail.update');
            Route::post('store', [TemplateEmailController::class, 'store'])->name('templatemail.store');
            Route::post('edit/{template}', [TemplateEmailController::class, 'edit'])->name('templatemail.edit');
            Route::get('delete/{template}', [TemplateEmailController::class, 'delete'])->name('templatemail.delete');

            Route::prefix('components')->group(function () {
                Route::post('upload-assets', [TemplateEmailController::class, 'uploadAsset'])->name('templatemail.upload_asset');
                Route::get('templates/{template}', [TemplateEmailController::class, 'getComponentTemplate'])->name('templatemail.components');
            });
        });

        Route::prefix('media-manager')->group(function () {
            Route::get('delete-media/{media}',[FolderManagerController::class,'deleteMedia'])->name('media.delete');
            Route::get('delete-folder/{folder}',[FolderManagerController::class,'deleteFolder'])->name('folder.delete');
            Route::get('/{path?}', [FolderManagerController::class, 'index'])
            ->where('path', '.*') 
            ->name('folders'); 

            Route::post("create-folder",[FolderManagerController::class,'insertFolder'])->name('folder.create');
            Route::post("create-media",[FolderManagerController::class,'insertMedia'])->name('media.create');
            
        });
    });

    Route::prefix('auto-reply')->group(function () {

        Route::prefix('chatbot')->group(function () {
            Route::get('/', [ChatBotController::class, 'index'])->name('chatbot');
            Route::get('create', [ChatBotController::class, 'create'])->name('chatbot.create');
            Route::get('update/{bot}', [ChatBotController::class, 'update'])->name('chatbot.update');
            Route::delete('delete/{bot}', [ChatBotController::class, 'delete']);
            Route::post('delete-multiple', [ChatBotController::class, 'deleteMultiple']);
            Route::post('store', [ChatBotController::class, 'store'])->name('chatbot.store');
            Route::post('edit/{bot}', [ChatBotController::class, 'edit'])->name('chatbot.edit');
            Route::post("import", [ChatBotController::class, 'import'])->name('chatbot.import');
        });

        Route::prefix('finetunnel')->group(function () {
            Route::get('/', [FineTunnelController::class, 'index'])->name('finetunnel');
            Route::get('create', [FineTunnelController::class, 'create'])->name('finetunnel.create');
            Route::get('update/{fineTunnel}', [FineTunnelController::class, 'update'])->name('finetunnel.update');
            Route::get('delete/{fineTunnel}', [FineTunnelController::class, 'delete'])->name('finetunnel.delete');
            Route::post('store', [FineTunnelController::class, 'store'])->name('finetunnel.store');
            Route::post('edit/{fineTunnel}', [FineTunnelController::class, 'edit'])->name('finetunnel.edit');
            Route::get('upload-tunnel/{fineTunnel}', [FineTunnelController::class, 'uploadDataSet'])->name('finetunnel.upload');
        });
    });

    Route::prefix('stores')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('stores');
        Route::get('create', [StoreController::class, 'create'])->name('stores.create');
        Route::get('update/{store}', [StoreController::class, 'update'])->name('stores.update');
        Route::post('store', [StoreController::class, 'store'])->name('stores.store');
        Route::post('import', [StoreController::class, 'import'])->name('stores.import');
        Route::post('edit/{store}', [StoreController::class, 'edit'])->name('stores.edit');
        Route::get('delete/{store}', [StoreController::class, 'delete'])->name('stores.delete');
        Route::get('export', [StoreController::class, 'export'])->name('stores.export');
    });

    Route::prefix('scrapping')->group(function () {
        Route::get('/', [StoreScrappingController::class, 'index'])->name('scrappings');
        Route::get('detail/{scrapping}', [StoreScrappingController::class, 'detail'])->name('scrappings.detail');
        Route::get('create', [StoreScrappingController::class, 'create'])->name('scrappings.create');
        Route::get('update/{scrapping}', [StoreScrappingController::class, 'update'])->name('scrappings.update');
        Route::post('store', [StoreScrappingController::class, 'store'])->name('scrappings.store');
        Route::post('edit/{scrapping}', [StoreScrappingController::class, 'edit'])->name('scrappings.edit');
        Route::get('delete/{scrapping}', [StoreScrappingController::class, 'delete'])->name('scrappings.delete');
        Route::post('status/{scrapping}', [StoreScrappingController::class, 'changeStatus']);
        Route::get('export/{scrapping}', [StoreScrappingController::class, 'export'])->name('scrappings.export');
    });

    Route::prefix('blash')->group(function () {
        Route::get('/', [BlashWhatsappController::class, 'index'])->name('blash');
        Route::get('detail/{blash}', [BlashWhatsappController::class, 'detail'])->name('blash.detail');
        Route::get('create', [BlashWhatsappController::class, 'create'])->name('blash.create');
        Route::get('update/{blash}', [BlashWhatsappController::class, 'update'])->name('blash.update');
        Route::post('store', [BlashWhatsappController::class, 'store'])->name('blash.store');
        Route::post('edit/{blash}', [BlashWhatsappController::class, 'edit'])->name('blash.edit');
        Route::get('delete/{blash}', [BlashWhatsappController::class, 'delete'])->name('blash.delete');
        Route::post('status/{blash}', [BlashWhatsappController::class, 'changeStatus']);
        Route::post('status-detail/{detail}', [BlashWhatsappController::class, 'changeStatusDetail']);
        Route::get('export/{blash}', [BlashWhatsappController::class, 'export'])->name('blash.export');
    });

    Route::prefix('blash-email')->group(function () {
        Route::get('/', [BlashEmailController::class, 'index'])->name('blash_email');
        Route::get('detail/{blash}', [BlashEmailController::class, 'detail'])->name('blash_email.detail');
        Route::get('create', [BlashEmailController::class, 'create'])->name('blash_email.create');
        Route::get('update/{blash}', [BlashEmailController::class, 'update'])->name('blash_email.update');
        Route::post('store', [BlashEmailController::class, 'store'])->name('blash_email.store');
        Route::post('edit/{blash}', [BlashEmailController::class, 'edit'])->name('blash_email.edit');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::post('change', [ProfileController::class, 'profile'])->name('profile.change');
        Route::post('password', [ProfileController::class, 'password'])->name('profile.password');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('setting');
        Route::post('generate-api-local', [SettingsController::class, 'generateApiKey']);
        Route::post('change', [SettingsController::class, 'updateConfiguration'])->name('setting.change');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::get('update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::post('edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('users.delete');
        Route::post('change-password/{user}', [UserController::class, 'changePassword'])->name('users.password');
    });

    Route::prefix('whatsapp-account')->group(function () {
        Route::get('/', [WhatsappController::class, 'index'])->name('whatsapp');
        Route::get('create', [WhatsappController::class, 'create'])->name('whatsapp.create');
        Route::get('update/{whatsapp}', [WhatsappController::class, 'update'])->name('whatsapp.update');
        Route::post('store', [WhatsappController::class, 'store'])->name('whatsapp.store');
        Route::post('edit/{whatsapp}', [WhatsappController::class, 'edit'])->name('whatsapp.edit');
        Route::post('status/{whatsapp}', [WhatsappController::class, 'changeStatus']);
        Route::get('delete/{whatsapp}', [WhatsappController::class, 'delete'])->name('whatsapp.delete');
    });

    Route::prefix('device')->group(function () {
        Route::get('/', [WhatsappDeviceController::class, 'index'])->name('device');
        Route::get('create', [WhatsappDeviceController::class, 'create'])->name('device.create');
        Route::get('update/{device}', [WhatsappDeviceController::class, 'update'])->name('device.update');
        Route::post('edit/{device}', [WhatsappDeviceController::class, 'edit'])->name('device.edit');
        Route::get('scan/{device}', [WhatsappDeviceController::class, 'scan'])->name('device.scan');
        Route::post('store', [WhatsappDeviceController::class, 'store'])->name('device.store');
        Route::post('status/{device}', [WhatsappDeviceController::class, 'changeStatus']);
        Route::get('delete/{device}', [WhatsappDeviceController::class, 'delete'])->name('device.delete');
        Route::get('doc-api/{device}', [WhatsappDeviceController::class, 'apiPage'])->name('device.doc');
        Route::post('chat-details/{device}/{chatId}', [WhatsappDeviceController::class, 'getChatDetails']);
        Route::post('send-message/{device}', [WhatsappDeviceController::class, 'sendMessage']);
        Route::get('setting/{device}', [WhatsappDeviceController::class, 'autoReply'])->name('device.setting');
        Route::post('update-setting/{device}', [WhatsappDeviceController::class, 'updateAutoReply'])->name('device.setting.update');

        Route::prefix('chats')->group(function () {
            Route::get('contacts/{device}', [SendMessageController::class, 'getContactList']);
            Route::get('/{device}', [SendMessageController::class, 'getChatList']);
            Route::get('detail/{device}/{chatId}', [SendMessageController::class, 'getChatDetails']);
            Route::post('send/{device}', [SendMessageController::class, 'sendMessage']);
        });

        Route::prefix('misc')->group(function () {
            Route::post("read-messages/{id}", [WhatsappMiscController::class, 'readMessage']);
            Route::post("delete-message/{id}", [WhatsappMiscController::class, 'deleteForMe']);
            Route::post("delete-everyone/{id}", [WhatsappMiscController::class, 'deleteEveryOne']);
            Route::post("download-media/{id}", [WhatsappMiscController::class, 'downloadMedia']);
            Route::post("get-profile/{id}", [WhatsappMiscController::class, 'getPhotoProfile']);
            Route::post("mark-message/{id}", [WhatsappMiscController::class, 'markMessage']);
            Route::post("delete-chat/{id}", [WhatsappMiscController::class, 'deleteChats']);
        });

        Route::prefix('sessions')->group(function () {
            Route::post('check/{device}', [WhatsappDeviceController::class, 'checkSession']);
            Route::post('create/{device}', [WhatsappDeviceController::class, 'createSession']);
            Route::post('logout/{device}', [WhatsappDeviceController::class, 'logoutSession']);
        });

        Route::prefix('message')->group(function () {
            Route::get('/', [WhatsappDeviceController::class, 'testSend'])->name('device.message');
            Route::post('store', [WhatsappDeviceController::class, 'singleSend'])->name('device.message.store');
        });

        Route::prefix('chat-app')->group(function () {
            Route::get('/{vue?}', function () {
                return view('chatapp');
            })->where('vue', '^(?!setup|update|password).*$')->name('device.chat');
        });
    });

    Route::prefix('waba')->group(function () {
        Route::get('/', [WhatsappWabaController::class, 'index'])->name('waba');
        Route::get('create', [WhatsappWabaController::class, 'create'])->name('waba.create');
        Route::post('store', [WhatsappWabaController::class, 'store'])->name('waba.store');
        Route::get('delete/{device}', [WhatsappWabaController::class, 'deleteIntegration'])->name('waba.delete');

        Route::prefix('update')->group(function () {
            Route::get('/{device}', [WhatsappWabaController::class, 'update'])->name('waba.update');
            Route::post('change-limit/{device}', [WhatsappWabaController::class, 'saveWebHook'])->name('waba.general.update');
            Route::get('autoreply/{device}', [WhatsappWabaController::class, 'autoreply'])->name('waba.autoreply');
            Route::post('autoreply-saving/{device}', [WhatsappWabaController::class, 'saveAutoReply'])->name('waba.autoreply.update');
            Route::get('greeting/{device}', [WhatsappWabaController::class, 'greeting'])->name('waba.greeting');
            Route::post('greeting-store/{device}', [WhatsappWabaController::class, 'saveGreeting'])->name('waba.greeting.update');
            Route::get('token/{device}', [WhatsappWabaController::class, 'token'])->name('waba.token');
            Route::get('refresh/{device}', [WhatsappWabaController::class, 'refresh'])->name('waba.refresh');
            Route::post('token-store/{device}', [WhatsappWabaController::class, 'saveToken'])->name('waba.token.update');
        });

        Route::prefix('templates')->group(function () {
            Route::get('/{device}', [WhatsappTemplateController::class, 'index'])->name('waba.templates');
            Route::get('sync/{device}', [WhatsappTemplateController::class, 'syncData'])->name('waba.sync_template');
            Route::get('create/{device}', [WhatsappTemplateController::class, 'create'])->name('waba.template.create');
            Route::get('update/{device}/{template}', [WhatsappTemplateController::class, 'update'])->name('waba.template.update');
            Route::get("details/{device}/{template}", [WhatsappTemplateController::class, 'details']);
            Route::post('store/{device}', [WhatsappTemplateController::class, 'store'])->name('waba.template.store');
            Route::post('edit/{device}/{template}', [WhatsappTemplateController::class, 'edit']);
            Route::get('delete/{device}/{template}', [WhatsappTemplateController::class, 'delete'])->name('waba.template.delete');
        });

        Route::prefix('broadcast')->group(function () {
            Route::get('/{device}', [WhatsappBroadcastController::class, 'index'])->name('waba.broadcast');
            Route::get('create/{device}', [WhatsappBroadcastController::class, 'create'])->name('waba.broadcast.create');
            Route::post('store/{device}', [WhatsappBroadcastController::class, 'store']);
            Route::get('update/{device}/{blash}', [WhatsappBroadcastController::class, 'update'])->name('waba.broadcast.update');
            Route::post("edit/{device}/{blash}", [WhatsappBroadcastController::class, 'edit']);
            Route::get('detail/{device}/{blash}', [WhatsappBroadcastController::class, 'detail'])->name('waba.broadcast.detail');
            Route::get('details/{device}/{blash}', [WhatsappBroadcastController::class, 'details']);
        });
    });

    Route::prefix('logs')->group(function () {
        Route::get('whatsapp', [LogController::class, 'whatsapp'])->name('logs.whatsapp');
        Route::get('statistic', [ReportController::class, 'index'])->name('reports.statistic');
        Route::get('email', [LogController::class, 'email'])->name('logs.email');
        Route::get('scrapping', [LogController::class, 'scrapping'])->name('logs.scrapping');
        Route::get('delete', [LogController::class, 'delete'])->name('logs.delete');
        Route::get('export', [LogController::class, 'export'])->name('logs.export');
    });
});
