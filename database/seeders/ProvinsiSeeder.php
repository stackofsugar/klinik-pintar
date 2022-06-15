<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("ref_provinsi")->insert(["id" => 1, "name" => "Jawa Tengah"]);
        DB::table("ref_provinsi")->insert(["id" => 2, "name" => "Jawa Barat"]);
        DB::table("ref_provinsi")->insert(["id" => 3, "name" => "Jawa Timur"]);
        DB::table("ref_provinsi")->insert(["id" => 4, "name" => "DKI Jakarta"]);
        DB::table("ref_provinsi")->insert(["id" => 5, "name" => "DI Yogyakarta"]);
        DB::table("ref_provinsi")->insert(["id" => 6, "name" => "Banten"]);
    }
}
