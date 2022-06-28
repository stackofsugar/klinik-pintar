<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPenyakit extends Model {
    use HasFactory;

    protected $table = "ref_penyakit";
    protected $guarded = ["id"];

    public static function searchByName(string $query) {
        return self::where("nama", "like", "%" . $query . "%")->get();
    }

    public static function searchById(int $id) {
        return self::where("id", "=", $id)->get();
    }
}
