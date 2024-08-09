<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::group(['as' => 'home.'], function () {
    Route::get("/", [HomeController::class, 'index'])->name("index");
    // عرض الصفحات
    Route::get("/page/{id}", [HomeController::class, 'getPage'])->name("pages.show");

    // تسجيل الدخول
    Route::post("/login/AdminOrUser", [HomeController::class, 'AdminOrUser'])->name("AdminOrUser");


    // محتوي الصفحة
    Route::get("/page/{id}", [HomeController::class, 'page'])->name("page");

    // البحث عن طالب
    Route::post("/talib/search", [HomeController::class, 'search'])->name("talib.search");


    // ولي الامر
    Route::get("/parent/{cid}",[HomeController::class,'parentPage'])->name("parent.home");
    Route::get("/parent/alaikhtibarat/{cid}",[HomeController::class,'parentAlaikhtibarat'])->name("parent.alaikhtibarat");
});
