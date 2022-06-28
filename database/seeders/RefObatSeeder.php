<?php

namespace Database\Seeders;

use App\Models\RefObat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefObatSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $obat = [
            ["Favipiravir 200 mg", 22500, "tablet"],
            ["Remdesivir 100 mg", 510000, "vial"],
            ["Oseltamivir 75 mg", 26000, "kapsul"],
            ["Intravenous Immunoglobulin 5% 50 ml", 3262300, "vial"],
            ["Intravenous Immunoglobulin 10% 25 ml", 3965000, "vial"],
            ["Intravenous Immunoglobulin 10% 50 ml", 6174900, "vial"],
            ["Ivermectin 12 mg", 7500, "tablet"],
            ["Tocilizumab 400 mg/20 ml", 5710600, "vial"],
            ["Tocilizumab 80 mg/4 ml", 1162200, "vial"],
            ["Azithromycin 500 mg", 1700, "tablet"],
            ["Ambroxol sirup 15 mg", 4455, "botol"],
            ["Cetirizine sirup 5 mg/5 ml", 15408, "botol"],
            ["Dramamine 50 mg", 2523, "tablet"],
            ["Postinor 750 cmg", 14177, "tablet"],
            ["Betadine 5 ml", 6528, "botol"],
            ["Demacolin", 7500, "strip"],
            ["Bodrex", 4573, "strip"],
            ["Ibuprofen 400 mg", 538, "tablet"],
            ["Imboost Force", 81540, "strip"],
            ["Sumagesic", 2790, "strip"],
            ["Degirol Loz", 14168, "strip"]
        ];

        foreach ($obat as $item) {
            RefObat::firstOrCreate([
                "nama" => $item[0],
                "harga" => $item[1],
                "satuan" => $item[2],
            ]);
        }
    }
}
