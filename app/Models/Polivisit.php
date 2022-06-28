<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polivisit extends Model {
    use HasFactory;

    protected $guarded = ["id"];

    public static function updateVisitByCode(string $reserve_code, int $penyakit_id) {
        $id_reservasi = Reservation::where("reservation_code", "=", $reserve_code)
            ->first()->id;
        $id_visits = Visit::where("id_reservasi", "=", $id_reservasi)
            ->first()->id;
        $poliVisitInstance = self::where("id_kunjungan", "=", $id_visits)
            ->first();

        $poliVisitInstance->id_penyakit = $penyakit_id;
        $poliVisitInstance->save();
    }

    public static function closeVisitByCode(string $reserve_code) {
        $id_reservasi = Reservation::where("reservation_code", "=", $reserve_code)
            ->first()->id;
        $id_visits = Visit::where("id_reservasi", "=", $id_reservasi)
            ->first()->id;
        $poliVisitInstance = self::where("id_kunjungan", "=", $id_visits)
            ->first();

        $poliVisitInstance->is_closed = true;
        $poliVisitInstance->save();
    }
}
