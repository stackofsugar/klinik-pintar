<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StrictAccessController extends Controller {
    public function accessControlTest(Request $request) {
        $user = $request->user();
        $var = [
            "username" => $user->username,
            "fullname" => $user->fullname,
            "gates" => [
                "admin" => [
                    "god" => $user->can("admin.god"),
                    "poli" => $user->can("admin.poli"),
                    "global" => $user->can("admin.global"),
                    "cashier" => $user->can("admin.cashier"),
                ],
                "doctor" => [
                    "active" => $user->can("doctor.active"),
                    "inactive" => $user->can("doctor.inactive"),
                ],
                "patient" => $user->can("patient"),
            ],
        ];

        dd($var);
    }

    public function showAdminDashboard() {
        return view("admin.dashboard");
    }
}
