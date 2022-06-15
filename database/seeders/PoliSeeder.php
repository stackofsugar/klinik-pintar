<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("ref_poli_bagian")->insert(["name" => "Umum", "cost" => 15000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Umum", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Onkologi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Ortopedi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Plastik", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Saraf", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Bedah Minor", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Anak", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Gigi dan Mulut", "cost" => 40000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Obgyn", "cost" => 45000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Penyakit Dalam", "cost" => 45000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Jantung", "cost" => 45000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Paru", "cost" => 45000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Mata", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Saraf", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "THT", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Fisioterapi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Radioterapi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Patologi Klinik", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Ortopedi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Psikiatri", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Psikologi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Kulit dan Kelamin", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Gizi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Hematologi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Imunologi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Hemodialisa", "cost" => 40000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Anastesi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Infeksi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Kardiologi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Nefrologi", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Neurologi", "cost" => 35000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Metabolik", "cost" => 30000]);
        DB::table("ref_poli_bagian")->insert(["name" => "Onkologi", "cost" => 35000]);
    }
}
