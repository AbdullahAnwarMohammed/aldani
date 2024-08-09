<?php

use App\Http\Controllers\Admin\AlhalaqatController;
use App\Http\Controllers\Admin\AlmustawayatController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\MangerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubscrptionController;
use App\Http\Controllers\Admin\TalibController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthAuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController as AuthRegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('/upload', [SliderController::class, 'store'])->name('upload.store');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    // الصفحة الرئيسية 
    Route::get('/', [HomeController::class, 'index'])->name('home');


    // الصلاحيات 


    Route::resource('permissions',  PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);


    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name("role.addPermission");
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name("role.updatePermission");;

    Route::resource('roles',  RoleController::class);

    // المتسويات
    // الاجزاء المضافة
    Route::get("parts/{id}", [AlmustawayatController::class, 'parts'])->name('almustawayat.parts');
    Route::post("add/part", [AlmustawayatController::class, 'addPart'])->name('almustawayat.add.part');
    Route::delete("destory/part/{id}", [AlmustawayatController::class, 'destoryPart'])->name('almustawayat.destory.part');
    Route::post("part/show/{id}", [AlmustawayatController::class, 'showPart'])->name('almustawayat.show.part');
    Route::post("part/update/{id}", [AlmustawayatController::class, 'updatePart'])->name('almustawayat.update.part');

    // المنهج

    Route::get("almanhaj/{id}/{id2}", [AlmustawayatController::class, 'almanhaj'])->name("almustawayat.almanhaj");
    Route::post("almanhaj/add", [AlmustawayatController::class, 'addAlmanhaj'])->name("almustawayat.add.almanhaj");
    Route::delete("destory/almanhaj/{id}", [AlmustawayatController::class, 'destoryAlmanhaj'])->name('almustawayat.destory.almanhaj');
    Route::post("almanhaj/show/{id}", [AlmustawayatController::class, 'showAlmanhaj'])->name('almustawayat.show.almanhaj');
    Route::post("almanhaj/update/{id}", [AlmustawayatController::class, 'updateAlmanhaj'])->name('almustawayat.update.almanhaj');

    // تعديل المنهج
    Route::get("almanhaj/{id}", [AlmustawayatController::class, 'almanhajEdit'])->name("almustawayat.almanhaj.edit");
    Route::post("almanhaj/{id}", [AlmustawayatController::class, 'almanhajUpdate'])->name("almustawayat.almanhaj.update");


    // المتسويات
    Route::post('almustawayat   /update/{id}', [AlmustawayatController::class, 'update'])->name("almustawayat.update.post");
    Route::resource('almustawayat', AlmustawayatController::class);


    // السلايدر
    Route::get("/slider", [SliderController::class, 'index'])->name("slider");
    Route::post("/slider/upload", [SliderController::class, 'store'])->name("slider.upload");
    Route::delete("/slider/delete/{id}", [SliderController::class, 'destory'])->name("slider.destory");

    Route::post('/slider/reorder', [SliderController::class, 'reorder'])->name('slider.reorder');
    // تعديل الصورة 
    Route::post('/slider/update', [SliderController::class, 'update'])->name("slide.update");
    // المدرء 
    Route::get("/mangers", [MangerController::class, 'index'])->name("manger.index");
    // صفحة ادخال البيانات للمدير
    Route::get("/manger/create", [RegisteredUserController::class, 'create'])->name("manger.create");
    // صفحة اضافة مدير
    Route::get("/manger/store", [RegisteredUserController::class, 'store'])->name("manger.store");

    // صفحة تعديل بيانات المدير
    Route::get("/manger/edit/{id}", [RegisteredUserController::class, 'edit'])->name("manger.edit");


    // حذف المدير
    Route::delete("/manger/delete/{id}", [AuthenticatedSessionController::class, 'delete'])->name("manger.delete");
    // جلب البيانات
    Route::post("/manger/show/{id}", [AuthenticatedSessionController::class, 'show'])->name("manger.show");
    // تعديل البيانات
    Route::post("/manger/update/{id}", [AuthenticatedSessionController::class, 'update'])->name("manger.update");


    // المحفظون
    Route::get("/users", [UserController::class, 'index'])->name("users.index");
    Route::post("/users/add", [AuthRegisteredUserController::class, 'store'])->name("users.add");
    Route::delete("/users/users/{id}", [AuthAuthenticatedSessionController::class, 'delete'])->name("users.delete");
    Route::post("/users/show/{id}", [AuthAuthenticatedSessionController::class, 'show'])->name("users.show");
    Route::post("/users/update/{id}", [AuthAuthenticatedSessionController::class, 'update'])->name("users.update");
    Route::get("/users/halqa/{id}", [UserController::class, 'halqa_show'])->name("users.halqa");
    // عرض تفاصيل المحفظ
    Route::get("users/details/{id}", [UserController::class, 'info'])->name('users.details');

    // تصدير الملف ك Excel 
    Route::get("users/export", [UserController::class, 'export'])->name('users.export');

    // الحافظون
    Route::get("talibs/halqa/{id}", [TalibController::class, 'users_by_halqa'])->name("talibs.halqa");
    // التفاصيل
    Route::get("talibs/details/{id}", [TalibController::class, 'details'])->name("talibs.details");

    // تصدير الملف ك Excel 
    Route::get("talibs/export", [TalibController::class, 'export'])->name('talibs.export');



    Route::resource("talibs", TalibController::class);





    // الحلقات

        // عند تغير الجنس ف اضافة محفظ جلب الحلفات المناسبة
    Route::get("talibs/by/alhalaqa", [AlhalaqatController::class, 'getAlhalaqaByTalb'])->name('talibs.by.alhalaqa');


    Route::post("/alhalaqat/type/{type}", [AlhalaqatController::class, 'get_by_type'])->name('alhalaqat.type');

    Route::resource("/alhalaqat", AlhalaqatController::class);

    //  الاشتراكات 
    Route::get("subscrption", [SubscrptionController::class, 'index'])->name("subscrption.index");
    // عرض اشتراك قبل التعديل
    Route::post("subscrption/show/{id}", [SubscrptionController::class, 'show'])->name("subscrption.show");
    // تعديل الاشتراك
    Route::post("subscrption/update/{id}", [SubscrptionController::class, 'update'])->name("subscrption.update");

    // صفحة اضافة اشتراك جديد
    Route::get("subscrption/add/{id}", [SubscrptionController::class, 'addSubscrption'])->name("subscrption.add");
    // حفظ بيانات الاشتراك الجديد
    Route::post("subscrption/store/newSubscrption", [SubscrptionController::class, 'newSubscrption'])->name("subscrption.new.store");

    // اظهار المدفوعات
    Route::get("subscrption/edit/{id}", [SubscrptionController::class, 'edit'])->name("subscrption.edit");
    // تعديل المدفوعات
    // Route::post("subscrption/update",[SubscrptionController::class,'update'])->name("subscrption.update.update");

    Route::get("subscrption/single/{id}", [SubscrptionController::class, 'single'])->name("subscrption.single");
    Route::get("subscrption/create/{id}", [SubscrptionController::class, 'create'])->name("subscrption.create");
    Route::post("subscrption/store", [SubscrptionController::class, 'store'])->name("subscrption.store");
    Route::post("subscrption/cancel/{id}", [SubscrptionController::class, 'cancel'])->name("subscrption.cancel");


    // اظهار مدفوعات كل اشتراك على حدة
    Route::get("subscrption/payments/{id}", [SubscrptionController::class, 'payments'])->name("subscrption.payments");

    // معرفة معلومات كل اشتراك شهرياً 
    Route::POST("subscrption/payments/ajax", [SubscrptionController::class, 'paymentsAjax'])->name("subscrption.payments.ajax");


    // الفاتورة
    Route::get("subscrption/invoice/{idInvoice}", [SubscrptionController::class, 'invoice'])->name("subscrption.invoice");


    // الاعدادت 
    Route::get("settings", [SettingController::class, 'index'])->name("settings.index");
    Route::post("settings/update", [SettingController::class, 'update'])->name("settings.update");

    // الصفحات
    Route::resource("pages", PageController::class);

    // الفصول التيرم
    Route::get("sessions", [SessionController::class, 'index'])->name("sessions.index");
    Route::post("sessions/store", [SessionController::class, 'store'])->name("sessions.store");
    Route::delete("sessions/destory/{id}", [SessionController::class, 'destory'])->name("sessions.destory");
    Route::post("/sessions/show/{id}", [SessionController::class, 'show'])->name("sessions.show");
    Route::post("/sessions/update/{id}", [SessionController::class, 'update'])->name("sessions.update");



    // Reports
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get("/", [ReportController::class, 'index'])->name("index");
        // المحفظين
        Route::get("/users", [ReportController::class, 'users'])->name("users");
        // الحافظين
        Route::get("/talibs", [ReportController::class, 'talibs'])->name("talibs");
        // الغياب
        Route::get("/absence", [ReportController::class, 'absence'])->name("absence");
        // الدراجات
        Route::get("/degree", [ReportController::class, 'degree'])->name("degree");
            Route::get("/users/by/alhalaqat",[ReportController::class,'usersByAlhalaqat'])->name('users.by.alhalaqat');

        // النتائج
        Route::get("/results",[ReportController::class,'result'])->name('talibs.result');
    });

    // Exports
    Route::group(['prefix' => 'export', 'as' => 'export.'], function () {
        Route::get("export/database", [ExportController::class, 'database'])->name("database");
        Route::get("export/database/all", [ExportController::class, 'AllDatabase'])->name("all.database");
        Route::post("export/database/file", [ExportController::class, 'ExportFile'])->name("file.database");
    });

    // Imports
    Route::group(['prefix' => 'import', 'as' => 'import.'], function () {
        Route::get("database", [ImportController::class, 'database'])->name("database");
        Route::get("database/all", [ImportController::class, 'AllDatabase'])->name("all.database");
        Route::post("database/file", [ImportController::class, 'ImportFile'])->name("file.database");

        Route::post("database", [ImportController::class, 'storeDatabase'])->name("store.database");
        Route::post("database/excel", [ImportController::class, 'storeDatabaseExcel'])->name("store.database.excel");
    });


    /*    Route::get("settings/import",[SettingController::class,'createDatabase'])->name("settings.create.database");
    Route::post("settings/export",[SettingController::class,'storeDatabase'])->name("settings.store.database");
*/
});

require __DIR__ . '/authAdmin.php';
