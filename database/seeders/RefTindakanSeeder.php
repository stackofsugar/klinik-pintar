<?php

namespace Database\Seeders;

use App\Models\RefTindakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefTindakanSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $tindakan = [
            ["insisi", 75000],
            ["insisi eksisi", 100000],
            ["nebulizer", 50000],
            ["home visit", 100000],
            ["orto removeable", 400000],
            ["retainer", 600000],
            ["klamer", 50000],
            ["grinding", 40000],
            ["tumpatan GIC kecil", 100000],
            ["tumpatan GIC sedang", 125000],
            ["tumpatan GIC besar", 150000],
            ["tumpatan LC kecil", 200000],
            ["tumpatan LC sedang", 225000],
            ["tumpatan LC besar", 250000],
            ["suntik KB 1 bulan", 30000],
            ["imunisasi TT hamil", 25000],
            ["veneer komposit gigi", 500000],
            ["reparasi akrilik rahang", 300000],
            ["crown akrilik", 400000],
            ["gigi tiruan akrilik", 2500000],
            ["ekstraksi gigi anak", 80000]
        ];

        foreach ($tindakan as $item) {
            RefTindakan::firstOrCreate([
                "nama" => $item[0],
                "harga" => $item[1]
            ]);
        }
    }
}
