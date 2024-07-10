<?php

use App\Http\Controllers\Almuhfazun\AlhalaqatController;
use App\Http\Controllers\Almuhfazun\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>'auth','prefix'=>'almuhfazun','as'=>'almuhfazun.'],function(){
    Route::get("/",[HomeController::class,'index'])->name("home");
    Route::get("/alhalaqat/{id}",[AlhalaqatController::class,'index'])->name("alhalaqat.index");
    Route::post("/alhalaqat/update",[AlhalaqatController::class,'update'])->name("alhalaqat.update");

    // جلب بيانات الطلاب
    Route::post("talibs/info/{id}",[HomeController::class,'talib_info'])->name("talib.info");

    // جلب بيانات المنهج
    Route::post("almanhaj/{id}",[HomeController::class,'getAlmanhaj'])->name("almanhaj.get");


    Route::post("tasmie/insert",[HomeController::class,'insertTasmie'])->name("tasmie.insert");

});



require __DIR__.'/auth.php';
