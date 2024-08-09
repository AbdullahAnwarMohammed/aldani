<?php

use App\Http\Controllers\almuhfazun\AlaikhtibaratController;
use App\Http\Controllers\Almuhfazun\AlhalaqatController;
use App\Http\Controllers\Almuhfazun\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth', 'prefix' => 'almuhfazun', 'as' => 'almuhfazun.'], function () {

    ############################### الصفحة الرئيسية #################
    Route::get("/", [HomeController::class, 'index'])->name("home");
    Route::get("/alhalaqat/{id}", [AlhalaqatController::class, 'index'])->name("alhalaqat.index");
    Route::post("/alhalaqat/update", [AlhalaqatController::class, 'update'])->name("alhalaqat.update");

    // جلب بيانات الطلاب
    Route::post("talibs/info/{id}", [HomeController::class, 'talib_info'])->name("talib.info");

    // جلب بيانات المنهج
    Route::post("almanhaj/{id}", [HomeController::class, 'getAlmanhaj'])->name("almanhaj.get");


    Route::post("tasmie/insert", [HomeController::class, 'insertTasmie'])->name("tasmie.insert");
    Route::post("tasmie/update/{id}", [HomeController::class, 'updateTasmie'])->name("tasmie.update");

    // جلب غرفة تسميع عند تغير الحلقة
    Route::post("/alhalaqat/room/{id}", [HomeController::class, 'getRoom'])->name("alhalaqat.get.room");

    // انشاء مجموعة جديدة
    Route::post("/group/create",[HomeController::class, 'createRoom'])->name('create.room');
    
    Route::post("/group/delete/person",[HomeController::class,'deletePersonFromGroup'])->name("group.delete.person");

    
    // حذف المجموعة
    Route::post("/group/delete/{id}",[HomeController::class,'deleteGroup'])->name("group.delete");


    // ادخال الطلاب داخل مجموعة معينة 
    Route::post("/group/insert",[HomeController::class,'insertGroup'])->name("group.insert");
    Route::post("/group/open",[HomeController::class,'groupOpen'])->name("group.open");


    ### الاختبارات #############
    Route::get("/alaikhtibarat",[AlaikhtibaratController::class,'index'])->name("alaikhtibarat.index");
    Route::post("/alaikhtibarat/info/{id}",[AlaikhtibaratController::class,'info'])->name("alaikhtibarat.info");
    
    Route::post("/alaikhtibarat/insert",[AlaikhtibaratController::class,'insert'])->name("alaikhtibarat.insert");
    Route::post("/alaikhtibarat/update",[AlaikhtibaratController::class,'update'])->name("alaikhtibarat.update");
    
});



require __DIR__ . '/auth.php';
