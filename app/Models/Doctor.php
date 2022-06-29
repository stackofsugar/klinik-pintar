<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Doctor extends Model {
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    public static function user() {
        $userID = Auth::user()->id;
        return self::where("user_id", "=", $userID)->first();
    }

    public static function getUserByID(int $id) {
        $userID = self::find($id)->user_id;
        return User::find($userID);
    }

    public static function getPoli() {
        $poliID = self::user()->poli_bagian_id;
        $poliName = DB::table("ref_poli_bagian")->where("id", "=", $poliID)->value("name");
        return "Poli " . $poliName;
    }
}
