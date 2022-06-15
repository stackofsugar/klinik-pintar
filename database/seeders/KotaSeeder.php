<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder {
    public function run() {
        // Jawa Tengah
        $cities = [
            ["is_city" => 1, "name" => "Magelang"], ["is_city" => 1, "name" => "Pekalongan"], ["is_city" => 1, "name" => "Salatiga"], ["is_city" => 1, "name" => "Semarang"], ["is_city" => 1, "name" => "Surakarta"], ["is_city" => 1, "name" => "Tegal"], ["is_city" => 0, "name" => "Banjarnegara"], ["is_city" => 0, "name" => "Banyumas"], ["is_city" => 0, "name" => "Batang"], ["is_city" => 0, "name" => "Blora"], ["is_city" => 0, "name" => "Boyolali"], ["is_city" => 0, "name" => "Brebes"], ["is_city" => 0, "name" => "Cilacap"], ["is_city" => 0, "name" => "Demak"], ["is_city" => 0, "name" => "Grobogan"], ["is_city" => 0, "name" => "Jepara"], ["is_city" => 0, "name" => "Karanganyar"], ["is_city" => 0, "name" => "Kebumen"], ["is_city" => 0, "name" => "Kendal"], ["is_city" => 0, "name" => "Klaten"], ["is_city" => 0, "name" => "Kudus"], ["is_city" => 0, "name" => "Magelang"], ["is_city" => 0, "name" => "Pati"], ["is_city" => 0, "name" => "Pekalongan"], ["is_city" => 0, "name" => "Pemalang"], ["is_city" => 0, "name" => "Purbalingga"], ["is_city" => 0, "name" => "Purworejo"], ["is_city" => 0, "name" => "Rembang"], ["is_city" => 0, "name" => "Semarang"], ["is_city" => 0, "name" => "Sragen"], ["is_city" => 0, "name" => "Sukoharjo"], ["is_city" => 0, "name" => "Tegal"], ["is_city" => 0, "name" => "Temanggung"], ["is_city" => 0, "name" => "Wonogiri"], ["is_city" => 0, "name" => "Wonosobo"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 1];
            DB::table("ref_kota")->insert([$value]);
        }

        // Jawa Barat
        $cities = [
            ["is_city" => 1, "name" => "Bandung"], ["is_city" => 1, "name" => "Banjar"], ["is_city" => 1, "name" => "Bekasi"], ["is_city" => 1, "name" => "Bogor"], ["is_city" => 1, "name" => "Cimahi"], ["is_city" => 1, "name" => "Cirebon"], ["is_city" => 1, "name" => "Depok"], ["is_city" => 1, "name" => "Sukabumi"], ["is_city" => 1, "name" => "Tasikmalaya"], ["is_city" => 0, "name" => "Bandung"], ["is_city" => 0, "name" => "Bandung Barat"], ["is_city" => 0, "name" => "Bekasi"], ["is_city" => 0, "name" => "Bogor"], ["is_city" => 0, "name" => "Ciamis"], ["is_city" => 0, "name" => "Cianjur"], ["is_city" => 0, "name" => "Cirebon"], ["is_city" => 0, "name" => "Garut"], ["is_city" => 0, "name" => "Indramayu"], ["is_city" => 0, "name" => "Karawang"], ["is_city" => 0, "name" => "Kuningan"], ["is_city" => 0, "name" => "Majalengka"], ["is_city" => 0, "name" => "Pangandaran"], ["is_city" => 0, "name" => "Purwakarta"], ["is_city" => 0, "name" => "Subang"], ["is_city" => 0, "name" => "Sukabumi"], ["is_city" => 0, "name" => "Sumedang"], ["is_city" => 0, "name" => "Tasikmalaya"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 2];
            DB::table("ref_kota")->insert([$value]);
        }

        // Jawa Timur
        $cities = [
            ["is_city" => 1, "name" => "Batu"], ["is_city" => 1, "name" => "Blitar"], ["is_city" => 1, "name" => "Kediri"], ["is_city" => 1, "name" => "Madiun"], ["is_city" => 1, "name" => "Malang"], ["is_city" => 1, "name" => "Mojokerto"], ["is_city" => 1, "name" => "Pasuruan"], ["is_city" => 1, "name" => "Probolinggo"], ["is_city" => 1, "name" => "Surabaya"], ["is_city" => 0, "name" => "Bangkalan"], ["is_city" => 0, "name" => "Banyuwangi"], ["is_city" => 0, "name" => "Blitar"], ["is_city" => 0, "name" => "Bojonegoro"], ["is_city" => 0, "name" => "Bondowoso"], ["is_city" => 0, "name" => "Gresik"], ["is_city" => 0, "name" => "Jember"], ["is_city" => 0, "name" => "Jombang"], ["is_city" => 0, "name" => "Kediri"], ["is_city" => 0, "name" => "Lamongan"], ["is_city" => 0, "name" => "Lumajang"], ["is_city" => 0, "name" => "Madiun"], ["is_city" => 0, "name" => "Mageta"], ["is_city" => 0, "name" => "Malang"], ["is_city" => 0, "name" => "Mojokerto"], ["is_city" => 0, "name" => "Nganjuk"], ["is_city" => 0, "name" => "Ngawi"], ["is_city" => 0, "name" => "Pacitan"], ["is_city" => 0, "name" => "Pamekasan"], ["is_city" => 0, "name" => "Pasuruan"], ["is_city" => 0, "name" => "Ponorogo"], ["is_city" => 0, "name" => "Probolinggo"], ["is_city" => 0, "name" => "Sampang"], ["is_city" => 0, "name" => "Sidoarjo"], ["is_city" => 0, "name" => "Situbondo"], ["is_city" => 0, "name" => "Sumenep"], ["is_city" => 0, "name" => "Trenggalek"], ["is_city" => 0, "name" => "Tuban"], ["is_city" => 0, "name" => "Tulungagung"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 3];
            DB::table("ref_kota")->insert([$value]);
        }

        // DKI Jakarta
        $cities = [
            ["is_city" => 1, "name" => "Administrasi Jakarta Barat"], ["is_city" => 1, "name" => "Administrasi Jakarta Pusat"], ["is_city" => 1, "name" => "Administrasi Jakarta Selatan"], ["is_city" => 1, "name" => "Administrasi Jakarta Timur"], ["is_city" => 1, "name" => "Administrasi Jakarta Utara"], ["is_city" => 0, "name" => "Administrasi Kep. Seribu"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 4];
            DB::table("ref_kota")->insert([$value]);
        }

        // DI Yogyakarta
        $cities = [
            ["is_city" => 1, "name" => "Yogyakarta"], ["is_city" => 0, "name" => "Bantul"], ["is_city" => 0, "name" => "Gunungkidul"], ["is_city" => 0, "name" => "Kulon Progo"], ["is_city" => 0, "name" => "Sleman"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 5];
            DB::table("ref_kota")->insert([$value]);
        }

        // Banten
        $cities = [
            ["is_city" => 1, "name" => "Cilegon"], ["is_city" => 1, "name" => "Serang"], ["is_city" => 1, "name" => "Tangerang"], ["is_city" => 1, "name" => "Tangerang Selatan"], ["is_city" => 0, "name" => "Lebak"], ["is_city" => 0, "name" => "Pandeglang"], ["is_city" => 0, "name" => "Serang"], ["is_city" => 0, "name" => "Tangerang"],
        ];
        foreach ($cities as $value) {
            $value += ["provinsi_id" => 6];
            DB::table("ref_kota")->insert([$value]);
        }
    }
}
