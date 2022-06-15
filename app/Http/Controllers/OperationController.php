<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationController extends Controller {
    public function showReservasi(Request $request) {
        $user = $request->user();
        if ($user->cannot("hasProfile") || $user->can("doctor.inactive")) {
            return redirect(route("profil"));
        } else if ($user->can("admin")) {
            return "lo admin";
        } else if ($user->can("doctor.active")) {
            return "lo dokter";
        } else {
            return view("auth.reservasi");
        }
    }
}
