<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefTindakan extends Model {
    use HasFactory;

    protected $table = "ref_tindakan";
    protected $guarded = ["id"];

    public static function getHargaByID(int $id) {
        return self::find($id)->harga;
    }
}
