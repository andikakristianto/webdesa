<?php

use App\Http\Controllers\Admin\AkteManagementController;
use App\Http\Controllers\Admin\KKManagementController;
use App\Http\Controllers\Admin\KTPManagementController;
use App\Http\Controllers\API\AKTEuserAPI;
use App\Http\Controllers\API\KKuserAPI;
use App\Http\Controllers\API\KTPuserAPI;
use App\Http\Controllers\API\MasyarakatAPI;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportUserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LayananAkteController;
use App\Http\Controllers\LayananKKController;
use App\Http\Controllers\LayananKTPController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Management\UserController as UserAdminController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| Role Admin dan Masyarakat
*/



Route::controller(LandingPageController::class)->prefix("/")->name("landing.")->group(function() {
    Route::get("/", "index");
    Route::get("/berita/{slug}", "berita")->name("berita");
});

Route::get("logout", [LoginController::class, "logout"])->name("logout");

Route::middleware(['guest'])->name("login.")->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('index');
    Route::get('/login/admin', [LoginController::class, 'indexadmin'])->name('index.admin');
    Route::post('/login/store', [LoginController::class, 'store'])->name('store');
});


// Global Route
Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->name('dashboard')->group(function(){
        Route::get('/', [DashboardController::class, 'index']);
    });

    Route::get("/profile", [DashboardController::class, "profile"])->name("profile");
    Route::put("/profileupdate", [DashboardController::class, "profileupdate"])->name("profileupdate");
});



    // User Route
    Route::middleware(['auth', 'role:user'])->group(function () {

        Route::controller(ControllersUserController::class)->prefix("/data")->name("data.")->group(function() {
            Route::get("/kk", "kk")->name("kk");
            Route::get("/ktp", "ktp")->name("ktp");
            Route::get("/akte", "akte")->name("akte");
        });


        Route::prefix('/layanankk')->name('layanankk.')->group(function(){
            Route::get('/', [LayananKKController::class, 'index']);
            Route::post('/store', [LayananKKController::class, 'store'])->name("store");
            Route::get('/edit/{id}', [LayananKKController::class, 'update'])->name("update");
            Route::put('/update/{id}/', [LayananKKController::class, 'updatestore'])->name("updatestore");

        });

        Route::prefix('/layananktp')->name('layananktp.')->group(function(){
            Route::get('/', [LayananKTPController::class, 'index']);
            Route::post('/store', [LayananKTPController::class, 'store'])->name("store");
            Route::get('/edit/{id}', [LayananKTPController::class, 'update'])->name("update");
            Route::put('/update/{id}/', [LayananKTPController::class, 'updatestore'])->name("updatestore");
        });

        Route::prefix('/layananakte')->name('layananakte.')->group(function(){
            Route::get('/', [LayananAkteController::class, 'index']);
            Route::post('/store', [LayananAkteController::class, 'store'])->name("store");
            Route::get('/edit/{id}', [LayananAkteController::class, 'update'])->name("update");
            Route::put('/update/{id}/', [LayananAkteController::class, 'updatestore'])->name("updatestore");
        });
    });



// Admin Route
Route::middleware(["auth", "role:admin"])->group(function() {

    Route::controller(ImportUserController::class)->prefix("/import")->name("import.")->group(function() {
        Route::get("/", "index")->name("index");
        Route::post("/store", "store")->name("store");
    });

    Route::prefix("/masyarakat")->name("masyarakat.")->group(function() {
        Route::get("/", [UserAdminController::class, "index"])->name("index");
        Route::get("/tambah", [UserAdminController::class, "tambah"])->name("tambah");
        Route::post("/store", [UserAdminController::class, "store"])->name("store");
        Route::get("/edit/{id}", [UserAdminController::class, "edit"])->name("edit");
        Route::put("/store/{id}", [UserAdminController::class, "editstore"])->name("editstore");
        Route::delete("/destroy/{id}", [UserAdminController::class, "destroy"])->name("destroy");
    });

    Route::prefix("/berita")->name("berita.")->group(function(){
        Route::get("/", [BeritaController::class, "index"])->name("index");
        Route::get("/create", [BeritaController::class, "create"])->name("create");
        Route::post("/store", [BeritaController::class, "store"])->name("store");
        Route::get("/edit/{id}", [BeritaController::class, "edit"])->name("edit");
        Route::put("/update/{id}", [BeritaController::class, "update"])->name("update");
        Route::delete("/destroy/{id}", [BeritaController::class, "destroy"])->name("destroy");
    });

    Route::prefix("/category")->name("category.")->group(function(){
        Route::get("/", [CategoryController::class, "index"])->name("index");
        Route::get("/add", [CategoryController::class, "tambahview"])->name("add");
        Route::get("/edit/{id}", [CategoryController::class, "edit"])->name("edit");
        Route::get("/store", [CategoryController::class, "store"])->name("store");
        Route::put("/update/{id}", [CategoryController::class, "update"])->name("update");
        Route::delete("/destroy/{id}", [CategoryController::class, "destroy"])->name("destroy");
    });


    Route::prefix("/management/kk",)->name("managementkk.")->group(function() {
        Route::get("/", [KKManagementController::class, "index"])->name("index");
        Route::put("/pending/{id}", [KKManagementController::class, "pending"])->name("pending");
        Route::put("/done/{id}", [KKManagementController::class, "done"])->name("done");
        Route::put("/reject/{id}", [KKManagementController::class, "reject"])->name("reject");
        Route::get("/comments/{id}", [LayananKKController::class, "message"])->name("getmessage");
        Route::put("/post/comments/{id}", [LayananKKController::class, "postmessage"])->name("postmessage");
        Route::delete("/destroy/{id}", [LayananKKController::class, "destroy"])->name("destroy");
    });

    Route::prefix("/management/ktp",)->name("managementktp.")->group(function() {
        Route::get("/", [KTPManagementController::class, "index"])->name("index");
        Route::put("/pending/{id}", [KTPManagementController::class, "pending"])->name("pending");
        Route::put("/done/{id}", [KTPManagementController::class, "done"])->name("done");
        Route::put("/reject/{id}", [KTPManagementController::class, "reject"])->name("reject");
        Route::get("/comments/{id}", [LayananKTPController::class, "message"])->name("getmessage");
        Route::put("/post/comments/{id}", [LayananKTPController::class, "postmessage"])->name("postmessage");
        Route::delete("/destroy/{id}", [LayananKTPController::class, "destroy"])->name("destroy");

    });
    Route::prefix("/management/akte",)->name("managementakte.")->group(function() {
        Route::get("/", [AkteManagementController::class, "index"])->name("index");
        Route::put("/pending/{id}", [AkteManagementController::class, "pending"])->name("pending");
        Route::put("/done/{id}", [AkteManagementController::class, "done"])->name("done");
        Route::put("/reject/{id}", [AkteManagementController::class, "reject"])->name("reject");
        Route::get("/comments/{id}", [LayananAkteController::class, "message"])->name("getmessage");
        Route::put("/post/comments/{id}", [LayananAkteController::class, "postmessage"])->name("postmessage");
        Route::delete("/destroy/{id}", [LayananAkteController::class, "destroy"])->name("destroy");

    });
});




















Route::get('/kkuser', [KKuserAPI::class, 'index']);
Route::get('/ktpuser', [KTPuserAPI::class, 'index']);
Route::get('/akteuser', [AKTEuserAPI::class, 'index']);
