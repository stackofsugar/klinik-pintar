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
    Route::middleware("auth")->group(function () {
        Route::get("/reservasi", "showReservasi")->name("reservasi");
        Route::post("/reservasi", "postReservasi");
        Route::delete("/reservasi", "deleteReservasi");
    });
});

Route::controller(StrictAccessController::class)->group(function () {
    Route::middleware("auth")->group(function () {
        Route::get("/test", "accessControlTest");
    });

    Route::middleware("can:admin")->group(function () {
        Route::get("/admin/dashboard", "showAdminDashboard");
        Route::get("/admin/dashboard/account/user", "showUserAccounts");

        Route::middleware("can:admin.godglobal")->group(function () {
            Route::get("/admin/dashboard/kunjungan", "showKunjungan")->name('kunjungan');
            Route::post("/admin/dashboard/kunjungan", "postKunjungan");
            Route::delete("/admin/dashboard/kunjungan", "deleteKunjungan");
        });

        Route::middleware("can:admin.godpoli")->group(function () {
            Route::get("admin/dashboard/kunjunganpoli", "showKunjunganPoli")->name("kunjunganpoli");
            Route::get("admin/dashboard/kunjunganpoli/{reserve_code}", "showIndividualKunjunganPoli")->name("kunjunganpoliindividual");
            Route::post("admin/dashboard/kunjunganpoli/{reserve_code}", "saveKunjunganPoli");

            Route::post("admin/dashboard/savetindakan", "saveTindakan")->name("saveTindakan");
            Route::post("admin/dashboard/deletetindakan", "deleteTindakan")->name("deleteTindakan");

            Route::post("admin/dashboard/savebhp", "saveBhp")->name("saveBhp");
            Route::post("admin/dashboard/deletebhp", "deleteBhp")->name("deleteBhp");

            Route::post("admin/dashboard/saveobat", "saveObat")->name("saveObat");
            Route::post("admin/dashboard/deleteobat", "deleteObat")->name("deleteObat");
        });

        Route::middleware("can:admin.godcashier")->group(function () {
            Route::get("admin/dashboard/tagihan", "showTagihan")->name("adminTagihan");
            Route::get("admin/dashboard/tagihan/{reserve_code}", "showIndividualTagihan")->name("adminIndividualTagihan");
        });
    });
});
