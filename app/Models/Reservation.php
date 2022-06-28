<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model {
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    public static function allByPatientID(int $patientID) {
        $result = self::leftJoin("visits", "visits.id_reservasi", "=", "reservations.id")
            ->leftJoin("polivisits", "visits.id", "=", "polivisits.id_kunjungan")
            ->where("reservations.id_pasien", "=", $patientID)
            ->select("reservations.*", "visits.id as id_visit", "polivisits.is_closed")
            ->get();

        return $result;
    }

    public static function activeByPatientID(int $patientID) {
        $result = self::leftJoin("visits", "visits.id_reservasi", "=", "reservations.id")
            ->where("reservations.id_pasien", "=", $patientID)
            ->where("visits.id_reservasi", "=", null)
            ->select("reservations.*")
            ->get();

        return $result;
    }

    public static function activeByCodeOrWarn(string $reservation_code) {
        $result = self::leftJoin("visits", "visits.id_reservasi", "=", "reservations.id")
            ->where("reservations.reservation_code", "=", $reservation_code)
            ->select("reservations.*", "visits.id_reservasi", "visits.waktu_kunjungan", "visits.id as id_kunjungan")
            ->first();

        if ($result == null) {
            return null;
        } else {
            return $result;
        }
    }

    public static function getPoliInstanceByID(int $reservation_id) {
        $reservationInstance = self::find($reservation_id);
        $poliInstance = DB::table("ref_poli_bagian")->where("id", "=", $reservationInstance->id_poli_bagian)->first();

        return $poliInstance;
    }

    public static function getPolivisitInstanceByCode(string $reservation_code) {
        $reservationInstance = self::where("reservation_code", "=", $reservation_code)->first();
        $kunjunganInstance = Visit::where("id_reservasi", "=", $reservationInstance->id)->first();
        $kunjunganPoliInstance = Polivisit::where("id_kunjungan", "=", $kunjunganInstance->id)->first();
        return $kunjunganPoliInstance;
    }
}
