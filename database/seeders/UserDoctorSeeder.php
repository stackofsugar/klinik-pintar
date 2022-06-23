<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDoctorSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $dokter = [
            ["dr. Helmi Usman", "helmiusman", "helmiusman@gmail.com"],
            ["dr. Fani Ndaruaji", "fanifanii", "fanindaruaji44@gmail.com"],
            ["dr. Sevika Melly", "ikamelly", "sevikaamelly@gmail.com"],
            ["dr. Novyanti Putri", "novyaputri", "novyaputri@gmail.com"],
            ["dr. Liana Natalia", "liananatalii", "liananatalia68@gmail.com"],
            ["dr. Neny Rifah", "nerifahh", "nenyrifah1717@gmail.com"],
            ["dr. Ichlas Rachmat", "ichlasmatt", "ichlasrachmatt@gmail.com"],
            ["dr. Fiantini Herawati", "fifiantini", "fiantiniwati@gmail.com"],
            ["dr. Andika Munda", "andkmunda", "andikamunda@gmail.com"],
            ["dr. Syafril Armansyah", "syafrilsyah", "syafrilarmansyah@gmail.com"],
            ["dr. Sylvia Gestie", "sylviagest", "sylviagestie19@gmail.com"],
            ["dr. Maura Putri", "mauraputt", "mauraputrii@gmail.com"],
            ["dr. Susanti Effendi", "susaneffendi", "susantieffendi@gmail.com"],
            ["dr. Fery Chandra", "feryychan", "feryychandra@gmail.com"],
            ["dr. Andri Siregar", "andrisiregar", "andrisiregar57@gmail.com"],
            ["dr. Ade Fitra", "adefitraww", "adefitraww@gmail.com"],
            ["dr. Abdul Gamal", "abdgamal", "abdulgamall@gmail.com"],
            ["dr. Mariaman Dera", "mariamander", "mariamanderaaw@gmail.com"],
            ["dr. Yudi Santoko", "yudsantokoo", "yudisantokoo@gmaul.com"],
            ["dr. Vien Anggarani", "vienangga", "vienanggarani10@gmail.com"],
            ["dr. Rahmi Damayanti", "rahmidmynt", "rahmidamayanti@gmail.com"],
            ["dr. Ratih Pitaloka", "ratihpitaa", "ratihpitaloka@gmail.com"],
            ["dr. Rosvy Walida", "rosvwalida", "rosvywalidaa@gmail.com"],
            ["dr. Susilo Wibowo", "susilowbowo", "susilowibowo@gmail.com"],
            ["dr. Vonny Hartanto", "vonnyhar", "vonnyhartanto@gmail.com"],
            ["dr. Rachmat Setiadi", "rachmatstd", "rachmatsetiadi@gmail.com"],
            ["dr. Nina Nurlinda", "ninanulinda", "ninanurlinda245@gmail.com"],
            ["dr. Istiqamah Sari", "istiqamahsari", "istiqamahsari788@gmail.com"],
            ["dr. Fauzia Liani", "fauziaani", "fauzialianii4@gmail.com"],
            ["dr. Maria Desy", "mariadesyy", "mariadesyy64@gmail.com"],
            ["dr. Maryo Ignatus", "maryonatus", "maryoignatus@gmail.com"],
            ["dr. Danang Erlangga", "danang_er", "danangerlangga@gmail.com"],
            ["dr. Rahmawati Silalahi", "rahmawatis", "rahmawatisilalahi@gmail.com"],
            ["dr. Dewi Yanti", "dewiynti", "dewiyanti112@gmail.com"],
            ["dr. Rai Purnami", "raipurnami", "raipurnami8@gmail.com"],
            ["dr. Mulyani Mus", "mulyanimusz", "mulyanimus5@gmail.com"],
            ["dr. Otto Kawanda", "ottokawanda", "ottokawanda9@gmail.com"],
            ["dr. Mariyani Fitriyanti", "mariyaniyanti", "mariyanifitriyanti@gmail.com"],
            ["dr. Sarif Hidayat", "sarifhdyt", "sarifhidayat@gmail.com"],
            ["dr. Wijaya Putra", "wijayaputra", "wijayaputaa2@gmail.com"],
            ["dr. Sri Murdiyah", "srimurdiyahh", "srimurdiyah24@gmail.com"],
            ["dr. Aditya Megananda", "adityamegaa", "adityamegananda@gmail.com"],
            ["dr. Abdul Arif", "abdariff", "abdulariff@gmail.com"],
            ["dr. Suryanti Bahri", "suryantibahri", "suryantibahri9@gmail.com"],
            ["dr. Zulkifli Adnan", "zuladnan", "zulkifliadnan@gmail.com"],
            ["dr. Arifin Chandra", "arifinchan", "arifinchandra@gmail.com"],
            ["dr. Mulyadi Pranoto", "mulyadiprnt", "mulyadipranoto29@gmail.com"],
            ["dr. Elina Amanwati", "elinawati", "elinaamanwati@gmail.com"],
            ["dr. Dyah Widowati", "dyahwidowati", "dyahwidowati71@gmail.com"],
            ["dr. Abdul Hanan", "abdulhanan", "abdulhanan67@gmail.com"],
            ["dr. Joko Narimo", "jokonarimo", "jokonarimo@gmail.com"],
            ["dr. Ernest Nathan", "nesthan", "nesthan@gmail.com"],
            ["dr. Garin Andaru", "garindaru", "garindaru@gmail.com"],
            ["dr. Yudhistira Janitra", "janitra", "janitra@gmail.com"],
            ["dr. Sary Sitiayuningrum", "sittiningrum", "sittiningrum@gmail.com"],
            ["dr. Kresna Putra", "putrakresna", "putrakresna@gmail.com"],
            ["dr. Bambang Suryono", "suryono", "suryono@gmail.com"],
            ["dr. Christabel Darmawan", "christabella", "christabella@gmail.com"],
            ["dr. Yudhistira Janitra", "janitra", "janitra@gmail.com"],
        ];

        $poli_bagian_id = 1;
        foreach ($dokter as $item) {
            $created_user = User::firstOrNew([
                "fullname" => $item[0],
                "username" => $item[1],
                "email" => $item[2],
            ]);
            if (!$created_user->exists) {
                $password = Hash::make($item[1]);
                $created_user->password = $password;
                $created_user->save();

                if ($poli_bagian_id == 35) {
                    $poli_bagian_id = 1;
                }

                Doctor::firstOrCreate([
                    "user_id" => $created_user->id,
                    "poli_bagian_id" => $poli_bagian_id,
                    "sip_num" => "123456789012345",
                    "phone_num" => "085447896581",
                    "is_active" => 1
                ]);
                $poli_bagian_id++;
            }
        }
    }
}
