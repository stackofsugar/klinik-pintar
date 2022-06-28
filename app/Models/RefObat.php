<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefObat extends Model {
    use HasFactory;

    protected $table = "ref_obat";
    protected $guarded = ["id"];

    public static function getHargaByID(int $id) {
        return self::find($id)->harga;
    }
}
