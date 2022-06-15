<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Patient extends Model {
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    public static function user() {
        $userID = Auth::user()->id;
        return self::where("user_id", "=", $userID)->first();
    }
}
