<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class OperationController extends Controller {
    public function showReservasi(Request $request) {
        $user = $request->user();
        if ($user->cannot("hasProfile") || $user->can("doctor.inactive")) {
            return redirect(route("profil"));
        } else if ($user->can("admin")) {
            return redirect("/admin/dashboard");
        } else if ($user->can("doctor.active")) {
            return redirect("/");
        } else {
            $idPasien = Patient::where("user_id", "=", Auth::user()->id)->first()->value("id");
            $listDokter = Doctor::select("doctors.id", "users.fullname", "doctors.poli_bagian_id")
                ->join("users", "users.id", "=", "doctors.user_id")
                ->where("is_active", "=", 1)
                ->get();
            $listPoli = DB::table("ref_poli_bagian")->pluck("name", "id");
            $listReservasi = Reservation::where("id_pasien", "=", $idPasien)->get();

            return view("auth.reservasi", [
                "list_poli" => $listPoli->all(),
                "list_dokter" => $listDokter->all(),
                "list_dokter_collect" => $listDokter,
                "list_reservasi" => $listReservasi->all(),
            ]);
        }
    }

    public function postReservasi(Request $request) {
        $validated = $request->validate(
            [
                "planned_arrival" => ["required", "date", "after_or_equal:today"],
                "id_poli_bagian" => ["required", "numeric"],
                "id_dokter" => ["required", "numeric"],
                "phone_num" => ["required", "numeric", "digits_between:11,13"],
            ],
            [
                "required" => "Semua atribut wajib diisi!",
                "planned_arrival.after_or_equal" => "Tanggal datang tidak boleh sebelum hari ini!",
                "id_poli_bagian.numeric" => "Atribut ini harus berupa angka",
                "id_dokter.numeric" => "Atribut ini harus berupa angka",
                "phone_num.numeric" => "Atribut ini harus berupa angka",
                "phone_num.digits_between" => "Nomor HP harus memuat antara :min dan :max digit!",
            ]
        );

        $dokter_id = $validated["id_dokter"];
        $poli_id = $validated["id_poli_bagian"];
        if ($dokter_id == 0) {
            throw ValidationException::withMessages([
                "id_dokter" => "Pilihan dokter anda tidak valid!"
            ]);
        }
        $dokter_instance = Doctor::findOr($dokter_id, function () {
            throw ValidationException::withMessages([
                "id_dokter" => "Pilihan dokter anda tidak valid!"
            ]);
        });
        if ($dokter_instance->poli_bagian_id != $poli_id) {
            dd($dokter_instance->poli_bagian_id, $poli_id);
            throw ValidationException::withMessages([
                "id_dokter" => "Pilihan dokter anda tidak valid!"
            ]);
        }

        $reservationCode = "";
        do {
            $reservationCode = Str::random(16);
        } while (Reservation::where("reservation_code", "=", $reservationCode)->first());
        $validated["reservation_code"] = Str::random(16);

        $validated["status_pasien"] = "terjadwal";
        $validated["id_pasien"] = Patient::where("user_id", "=", Auth::user()->id)->first()->value("id");

        Reservation::create($validated);
        return redirect(route("reservasi"))->with("successAlert", "Reservasi anda berhasil disimpan!");
    }

    public function deleteReservasi(Request $request) {
        $reservationInstance = Reservation::where("reservation_code", "=", $request->reservation_code)->first();
        $reservationInstance->delete();
        return redirect(route("reservasi"))->with("successAlert", "Reservasi anda berhasil dihapus!");
    }
}
