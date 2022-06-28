<?php

namespace Database\Seeders;

use App\Models\RefBHP;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefBHPSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $bhp = [
            ["wash glove", 17000, "pcs"],
            ["celemek medis standar rumah sakit", 5000, "pcs"],
            ["selang urine pediatric", 100000, "box"],
            ["selang urine silicone", 100000, "box"],
            ["urine bag", 55000, "box"],
            ["cleansing enema set", 18500, "pcs"],
            ["kantong kolostomi medis", 320000, "pcs"],
            ["kantong kolostomi standar", 26000, "pcs"],
            ["kasa perban", 50000, "box"],
            ["selang transfusi darah", 4400, "pcs"],
            ["benang operasi", 144000, "box"],
            ["diapers popok dewasa", 70000, "box"],
            ["alas plastik melahirkan", 25000, "pcs"],
            ["surgical glove", 300000, "box"],
            ["nitrile glove", 125000, "box"],
            ["doctor cap", 38000, "box"],
            ["nurse cap", 32000, "box"],
            ["waslap rambut", 23500, "pcs"],
            ["waslap badan", 20000, "pcs"],
            ["dressing set", 25000, "pcs"],
            ["transparent film dressing frame", 120000, "box"]
        ];

        foreach ($bhp as $item) {
            RefBHP::firstOrCreate([
                "nama" => $item[0],
                "harga" => $item[1],
                "satuan" => $item[2],
            ]);
        }
    }
}
