<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    // Get active Doctor(s)
    public static function active() {
    }
}
