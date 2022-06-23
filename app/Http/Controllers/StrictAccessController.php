<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function showUserAccounts(Request $request) {
        $perPage = 10;
        if ($request->has("perpage") && is_numeric($request->perpage)) {
            $perPage = $request->perpage;
        }

        $users = User::paginate($perPage);
        $users->appends(["perpage" => $perPage]);

        return view("admin.useracc", [
            "users" => $users
        ]);
    }
}
