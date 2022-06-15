<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\StrictAccessController;
use App\Http\Controllers\UnauthController;

Route::controller(UnauthController::class)->group(function () {
    Route::get("/", "index")->name("home");
    Route::get("/tentang", "about");
    Route::get("/kontak", "contact");
    Route::get("/acknowledgements", "acknowledgements");
    Route::post("/kontak", "submitContactMessage")->name("submitContactMessage");
});

Route::controller(AuthController::class)->group(function () {
    Route::middleware("guest")->group(function () {
        Route::get("/login", "viewLogin")->name("login");
        Route::get("/register", "viewRegister")->name("register");
        Route::post("/login", "authenticate");
        Route::post("/register", "store");
    });

    Route::middleware("auth")->group(function () {
        Route::get("/logout", "destroy")->name("logout");
        Route::get("/profil", "profil")->name("profil");

        // Profile Creation
        Route::middleware("can:hasNoProfile")->group(function () {
            Route::get("/buatprofil", "viewProfileCreation");
            Route::get("/buatprofil/pasien", "viewProfileCreationPatient");
            Route::get("/buatprofil/dokter", "viewProfileCreationDoctor");
            Route::post("/buatprofil/pasien", "storeProfileCreationPatient");
            Route::post("/buatprofil/dokter", "storeProfileCreationDoctor");
        });
    });
});

Route::controller(OperationController::class)->group(function () {
    Route::get("/reservasi", "showReservasi");
});

Route::controller(StrictAccessController::class)->group(function () {
    Route::middleware("auth")->group(function () {
        Route::get("/test", "accessControlTest");
    });

    Route::middleware("can:admin")->group(function () {
        Route::get("/admin/dashboard", "showAdminDashboard");
    });
});
