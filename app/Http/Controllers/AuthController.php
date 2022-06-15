<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * >>> Main Auth Controller <<<
 * > Contains:
 * views
 * store (register)
 * authenticate (login)
 * destroy (logout)
 * edit (edit profile)
 */
class AuthController extends Controller {
    public function viewLogin(Request $request) {
        if (RateLimiter::tooManyAttempts("authenticate" . $request->ip(), env("DEF_LOGIN_THROTTLE_PERMIN", 5))) {
            $seconds = RateLimiter::availableIn("authenticate" . $request->ip());
            $rejectString = "Anda melakukan terlalu banyak percobaan gagal! Kembali lagi dalam " . $seconds . " detik";
            session()->flash("loginError", $rejectString);
        }
        return view("auth.login");
    }

    public function viewRegister() {
        return view("auth.register");
    }

    public function profil() {
        $key = env("DEF_JWT_SECRET");
        $exp = 60 * 20;
        $algo = "HS256";
        $payload = [
            "iss" => "KlinikPintar",
            "iat" => time(),
            "exp" => time() + $exp,
            "username" => Auth::user()->username,
        ];
        $token = JWT::encode($payload, $key, $algo);

        return view("profil", [
            "apiToken" => $token,
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate(
            [
                "fullname" => ["required", "max:255", "min:3"],
                "username" => ["required", "max:16", "min:3", "unique:users", "alpha_dash"],
                "email" => ["required", "email:dns", "unique:users"],
                "password" => ["required", "confirmed", "max:32", "min:8"],
            ],
            [
                "required" => "Atribut ini wajib diisi!",
                "alpha_dash" => "Atribut hanya boleh berisi karakter alfanumerik, dash (-), dan underscore (_)",
                "email" => "Format alamat email tidak valid!",
                "min" => "Atribut ini harus memuat setidaknya :min karakter!",
                "max" => "Atribut ini maksimal memuat :max karakter!",
                "confirmed" => "Password dan konfirmasi harus sama!",
                "unique" => "Atribut ini sudah digunakan!"
            ]
        );

        $validated["password"] = Hash::make($validated["password"]);

        $created_user = User::create($validated);
        Auth::login($created_user);

        return redirect(route("home"));
    }

    public function authenticate(Request $request) {
        $executed = RateLimiter::attempt(
            "authenticate" . $request->ip(),
            $perMinute = env("DEF_LOGIN_THROTTLE_PERMIN", 5),
            function () {
            }
        );

        if (!$executed) {
            $seconds = RateLimiter::availableIn("authenticate" . $request->ip());
            $rejectString = "Anda melakukan terlalu banyak percobaan gagal! Kembali lagi dalam " . $seconds . " detik";
            return back()->with("loginError", $rejectString);
        }

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = false;
        if (isset($request->all()["remember"])) {
            $remember = true;
        }

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear("authenticate" . $request->ip());
            $request->session()->regenerate();
            return redirect()->intended(route("home"));
        }

        return back()->with("loginError", "Username atau Password yang anda berikan tidak sesuai dengan data dalam database");
    }

    public function destroy(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route("home"));
    }

    public function viewProfileCreation() {
        return view("profilecreation.buatprofil");
    }

    public function viewProfileCreationPatient() {
        $listProvinsi = DB::table("ref_provinsi")->get();
        $listKota = DB::table("ref_kota")->get();

        return view("profilecreation.profilpasien", ["list_provinsi" => $listProvinsi->all(), "list_kota" => $listKota->all()]);
    }

    public function viewProfileCreationDoctor() {
        $listPoli = DB::table("ref_poli_bagian")->pluck("name", "id");

        return view("profilecreation.profildokter", ["list_poli" => $listPoli->all()]);
    }

    public function storeProfileCreationPatient(Request $request) {
        $validated = $request->validate(
            [
                "nik" => ["required", "numeric", "digits:16", "unique:patients"],
                "place_of_birth" => ["required", "max:255"],
                "date_of_birth" => ["required", "date"],
                "address" => ["required", "max:255"],
                "rt" => ["required", "numeric", "digits_between:1,10", "min:1"],
                "rw" => ["required", "numeric", "digits_between:1,10", "min:1"],
                "provinsi_id" => ["required", "numeric", "min:1"],
                "kota_id" => ["required", "numeric", "min:1"],
            ],
            [
                "provinsi_id.min" => "Pilihan ini tidak valid!",
                "kota_id.min" => "Pilihan ini tidak valid!",
                "required" => "Atribut ini wajib diisi!",
                "min" => "Atribut ini harus lebih dari :min!",
                "max" => "Atribut ini harus kurang dari :max!",
                "unique" => "Atribut ini sudah digunakan!",
                "digits" => "Atribut ini harus memuat :digits digit!",
                "digits_between" => "Atribut ini harus memuat antara :min dan :max digit!",
                "numeric" => "Atribut ini harus berupa angka",
                "date" => "Atribut ini harus berupa tanggal yang valid!",
            ]
        );

        $provinsiID = $validated["provinsi_id"];
        $kotaID = $validated["kota_id"];
        $referencedProvinsiID = DB::table("ref_kota")
            ->where("id", "=", $kotaID)->value("provinsi_id");
        if ($referencedProvinsiID != $provinsiID) {
            throw ValidationException::withMessages([
                "provinsi_id" => "Pilihan ini tidak valid!",
                "kota_id" => "Pilihan ini tidak valid!",
            ]);
        }

        $rand_rm = 0;
        do {
            $rand_rm = random_int(100000000000, 999999999999);
        } while (Patient::where("no_rm", "=", $rand_rm)->first());
        $validated += [
            "no_rm" => $rand_rm,
            "user_id" => Auth::id(),
        ];

        Patient::create($validated);
        return redirect(route("profil"));
    }

    public function storeProfileCreationDoctor(Request $request) {
        $validated = $request->validate([
            "sip_num" => ["required", "between:10,20"],
            "poli_bagian_id" => ["required", "numeric", "min:1"],
            "phone_num" => ["required", "numeric", "digits_between:11,13"],
        ], [
            "poli_bagian_id.min" => "Pilihan ini tidak valid!",
            "required" => "Atribut ini wajib diisi!",
            "between" => "Atribut ini harus memuat :min - :max karakter!",
            "digits_between" => "Atribut ini harus memuat antara :min dan :max digit!",
            "numeric" => "Atribut ini harus berupa angka",
        ]);

        $poliBagianID = $validated["poli_bagian_id"];
        $referencedPoliBagianID = DB::table("ref_poli_bagian")
            ->where("id", "=", $poliBagianID)->first();
        if ($referencedPoliBagianID == null) {
            throw ValidationException::withMessages(["poli_bagian_id" => "Pilihan ini tidak valid!"]);
        }

        $validated += [
            "user_id" => Auth::id(),
        ];

        Doctor::create($validated);
        return redirect(route("profil"));
    }

    public function test() {
        $return = false;
        $user_id = Auth::id();
        $result = Admin::join("users", "users.id", "=", "admins.user_id")
            ->where("users.id", "=", $user_id)
            ->where("level", "=", "god")
            ->first();
        if ($result) {
            $return = true;
        }

        return [$return];
    }
}
