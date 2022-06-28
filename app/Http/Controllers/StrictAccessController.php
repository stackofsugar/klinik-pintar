<?php

namespace App\Http\Controllers;

use App\Models\Bhp;
use App\Models\Doctor;
use App\Models\Obat;
use App\Models\Patient;
use App\Models\Polivisit;
use App\Models\RefBHP;
use App\Models\RefObat;
use App\Models\RefPenyakit;
use App\Models\RefTindakan;
use App\Models\Reservation;
use App\Models\Tindakan;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class StrictAccessController extends Controller {
    public function accessControlTest(Request $request) {
        $user = $request->user();
        $var = [
            "username" => $user->username,
            "fullname" => $user->fullname,
            "gates" => [
                "admin" => [
                    "god" => $user->can("admin.god"),
                    "poli" => $user->can("admin.poli"),
                    "global" => $user->can("admin.global"),
                    "cashier" => $user->can("admin.cashier"),
                ],
                "doctor" => [
                    "active" => $user->can("doctor.active"),
                    "inactive" => $user->can("doctor.inactive"),
                ],
                "patient" => $user->can("patient"),
            ],
        ];

        dd($var);
    }

    public function showAdminDashboard() {
        return view("admin.dashboard");
    }

    public function showUserAccounts(Request $request) {
        $perPage = 10;
        if ($request->has("perpage") && is_numeric($request->perpage)) {
            $perPage = $request->perpage;
        }

        $users = User::paginate($perPage);
        $users->appends(["perpage" => $perPage]);

        return view("admin.useracc", [
            "users" => $users
        ]);
    }

    public function showKunjungan(Request $request) {
        if ($request->query("reserve_code") == null) {
            return view("admin.kunjungan");
        }

        $reserveInstance = Reservation::activeByCodeOrWarn($request->query("reserve_code"));
        $request->flash();

        if ($reserveInstance == null) {
            session()->flash("reserveError", "Kode reservasi tidak ditemukan!");
        } else if ($reserveInstance->id_reservasi != null) {
            session()->flash("reserveError", "Reservasi sudah diperiksa awal!");
        } else {
            $idPasien = $reserveInstance->id_pasien;
            $idDokter = $reserveInstance->id_dokter;
            $idPoli = $reserveInstance->id_poli_bagian;

            $instancePasien = Patient::find($idPasien);
            $useridPasien = $instancePasien->user_id;
            $ttlPasien = $instancePasien->date_of_birth;
            $useridDokter = Doctor::find($idDokter)->user_id;

            $namaPasien = User::find($useridPasien)->fullname;
            $namaDokter = User::find($useridDokter)->fullname;
            $namaPoli = DB::table("ref_poli_bagian")->find($idPoli)->name;

            session()->flash("reserveSuccess", "Kode reservasi ditemukan!");
            session()->flash("reserveInstance", $reserveInstance);
            session()->flash("namaPasien", $namaPasien);
            session()->flash("ttlPasien", $ttlPasien);
            session()->flash("namaDokter", $namaDokter);
            session()->flash("namaPoli", $namaPoli);
        }

        return view("admin.kunjungan");
    }

    protected function _deleteKunjungan($reservationCode) {
        $reservationInstance = Reservation::where("reservation_code", "=", $reservationCode)->first();
        if ($reservationInstance != null) {
            $reservationInstance->delete();
            return true;
        } else {
            return false;
        }
    }

    public function postKunjungan(Request $request) {
        $validated = $request->validate([
            "bp_sistole" => ["required", "numeric"],
            "bp_diastole" => ["required", "numeric"],
            "heart_rate" => ["required", "numeric"],
            "date-of-birth" => ["required", "date"],
            "reserve_code" => ["required"],
        ], [
            "required" => "Atribut ini wajib diisi!",
            "numeric" => "Atribut ini harus berupa angka!",
            "date" => "Ada kesalahan dengan tanggal!"
        ]);

        $validated["waktu_kunjungan"] = date('Y-m-d H:i:s', time());

        $ageInterval = date_diff(date_create(), date_create($validated["date-of-birth"]));
        $validated["age_years"] = $ageInterval->format("%Y");
        $validated["age_months"] = $ageInterval->format("%M");
        $validated["age_days"] = $ageInterval->format("%D");

        $reservationInstance = Reservation::where("reservation_code", "=", $validated["reserve_code"])->first();
        $validated["id_pasien"] = $reservationInstance->id_pasien;
        $validated["id_reservasi"] = $reservationInstance->id;

        unset($validated["date-of-birth"]);
        unset($validated["reserve_code"]);

        Visit::create($validated);
        return redirect(route("kunjungan"))->with("reserveSuccess", "Kunjungan awal berhasil dibuat!");
    }

    public function deleteKunjungan(Request $request) {
        if ($this->_deleteKunjungan($request->reserve_code)) {
            return redirect(route("kunjungan"))->with("reserveSuccess", "Reservasi berhasil dihapus!");
        } else {
            return redirect()->back()->with("reserveError", "Reservasi gagal dihapus!");
        }
    }

    public function showKunjunganPoli(Request $request) {
        if ($request->query("reservation_code") == null) {
            return view("admin.kunjunganpoli");
        } else {
            $reserveInstance = Reservation::activeByCodeOrWarn($request->query("reservation_code"));
            $request->flash();

            if ($reserveInstance == null) {
                session()->flash("reserveError", "Kunjungan tidak bisa ditemukan!");
            } else if ($reserveInstance->id_reservasi == null) {
                session()->flash("reserveError", "Pasien belum berkunjung ke KlinikPintar!");
            } else {
                $kunjunganPoliInstance = Polivisit::firstWhere("id_kunjungan", "=", $reserveInstance->id_kunjungan);

                if ($kunjunganPoliInstance == null) {
                    session()->flash("statusKunjungan", "belum");
                } else if (!$kunjunganPoliInstance->is_closed) {
                    session()->flash("statusKunjungan", "aktif");
                } else {
                    session()->flash("statusKunjungan", "tutup");
                }

                $idPasien = $reserveInstance->id_pasien;
                $idDokter = $reserveInstance->id_dokter;
                $idPoli = $reserveInstance->id_poli_bagian;

                $instancePasien = Patient::find($idPasien);
                $useridPasien = $instancePasien->user_id;
                $useridDokter = Doctor::find($idDokter)->user_id;

                $namaPasien = User::find($useridPasien)->fullname;
                $namaDokter = User::find($useridDokter)->fullname;
                $namaPoli = DB::table("ref_poli_bagian")->find($idPoli)->name;

                session()->flash("reserveSuccess", "Kunjungan ditemukan!");
                session()->flash("reserveInstance", $reserveInstance);
                session()->flash("namaPasien", $namaPasien);
                session()->flash("namaDokter", $namaDokter);
                session()->flash("namaPoli", $namaPoli);
            }

            return view("admin.kunjunganpoli");
        }
    }

    public function showIndividualKunjunganPoli(Request $request, $reserve_code) {
        $reserveInstance = Reservation::activeByCodeOrWarn($reserve_code);
        if (($reserveInstance == null) || ($reserveInstance->id_reservasi == null)) {
            abort(404, "Parameter not found");
        } else {
            $kunjunganPoliInstance = Polivisit::where("id_kunjungan", "=", $reserveInstance->id_kunjungan)
                ->firstOr(function () use ($reserveInstance) {
                    $poliInstance = Reservation::getPoliInstanceByID($reserveInstance->id);
                    $createdKunjunganPoliInstance = Polivisit::create([
                        "id_kunjungan" => $reserveInstance->id_kunjungan,
                        "cost" => $poliInstance->cost,
                    ]);
                    return $createdKunjunganPoliInstance;
                });

            $searchDiagnosisResult = null;
            $haveFailedSearch = false;

            if ($request->query("cari-diagnosis") != null) {
                $request->flash();
                $searchDiagnosisQuery = $request->query("cari-diagnosis");
                $searchDiagnosisResult = RefPenyakit::searchByName($searchDiagnosisQuery)->all();
                if (!$searchDiagnosisResult) {
                    $haveFailedSearch = true;
                }
            } else if ($kunjunganPoliInstance->id_penyakit != null) {
                $searchDiagnosisResult = RefPenyakit::searchById($kunjunganPoliInstance->id_penyakit)->all();
            }

            $returnURL = route("kunjunganpoli", ["reservation_code" => $reserve_code]);

            if ($kunjunganPoliInstance->is_closed) {
                return view("admin.kunjunganpolitutup", [
                    "returnURL" => $returnURL,
                    "kodeReservasi" => $reserve_code,
                ]);
            }

            $idPasien = $reserveInstance->id_pasien;
            $idDokter = $reserveInstance->id_dokter;
            $idPoli = $reserveInstance->id_poli_bagian;

            $instancePasien = Patient::find($idPasien);
            $useridPasien = $instancePasien->user_id;
            $useridDokter = Doctor::find($idDokter)->user_id;

            $namaPasien = User::find($useridPasien)->fullname;
            $namaDokter = User::find($useridDokter)->fullname;
            $namaPoli = DB::table("ref_poli_bagian")->find($idPoli)->name;

            $listTindakan = RefTindakan::select("id", "nama", "harga")->get()->all();
            $listBHP = RefBHP::select("id", "nama", "harga", "satuan")->get()->all();
            $listObat = RefObat::select("id", "nama", "harga", "satuan")->get()->all();

            $savedTindakan = Tindakan::join("ref_tindakan", "tindakan.id_tindakan", "=", "ref_tindakan.id")
                ->select("ref_tindakan.nama", "tindakan.jumlah", "tindakan.id")
                ->where("tindakan.id_polivisit", "=", $kunjunganPoliInstance->id)
                ->get()->all();

            $savedBhp = Bhp::join("ref_bhp", "bhp.id_bhp", "=", "ref_bhp.id")
                ->select("ref_bhp.nama", "bhp.jumlah", "bhp.id", "ref_bhp.satuan")
                ->where("bhp.id_polivisit", "=", $kunjunganPoliInstance->id)
                ->get()->all();

            $savedObat = Obat::join("ref_obat", "obat.id_obat", "=", "ref_obat.id")
                ->select("ref_obat.nama", "obat.jumlah", "obat.id", "ref_obat.satuan")
                ->where("obat.id_polivisit", "=", $kunjunganPoliInstance->id)
                ->get()->all();

            return view("admin.kunjunganpoliindiv", [
                "returnURL" => $returnURL,
                "namaPasien" => $namaPasien,
                "namaDokter" => $namaDokter,
                "namaPoli" => $namaPoli,
                "kodeReservasi" => $reserve_code,
                "listPenyakit" => $searchDiagnosisResult,
                "haveFailedSearch" => $haveFailedSearch,
                "listTindakan" => $listTindakan,
                "savedTindakan" => $savedTindakan,
                "listBHP" => $listBHP,
                "savedBhp" => $savedBhp,
                "listObat" => $listObat,
                "savedObat" => $savedObat,
            ]);
        }
    }

    public function saveKunjunganPoli(Request $request, $reserve_code) {
        Polivisit::updateVisitByCode($reserve_code, $request->diagnosis);
        if ($request->save_prompt != null) {
            Polivisit::closeVisitByCode($reserve_code);
            return redirect(route("kunjunganpoli", ["reservation_code" => $reserve_code]));
        }
        session()->flash("mainSuccess", "Kunjungan Poli berhasil disimpan!");
        return redirect(route('kunjunganpoliindividual', $reserve_code));
    }

    public function saveTindakan(Request $request) {
        $id_polivisit = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $harga_tindakan = RefTindakan::getHargaByID($request->tindakan);

        Tindakan::create([
            "id_polivisit" => $id_polivisit,
            "id_tindakan" => $request->tindakan,
            "harga" => $harga_tindakan,
            "jumlah" => $request->tindakan_jumlah,
        ]);

        session()->flash("mainSuccess", "Tindakan berhasil disimpan!");
        return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
    }

    public function deleteTindakan(Request $request) {
        $polivisitID = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $tindakanInstance = Tindakan::find($request->tindakan_id);
        if ($polivisitID != $tindakanInstance->id_polivisit) {
            abort(403);
        } else {
            $tindakanInstance->delete();
            session()->flash("mainSuccess", "Tindakan berhasil dihapus!");
            return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
        }
    }

    public function saveBhp(Request $request) {
        $id_polivisit = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $hargaBhp = RefBHP::getHargaByID($request->bhp);

        Bhp::create([
            "id_polivisit" => $id_polivisit,
            "id_bhp" => $request->bhp,
            "harga" => $hargaBhp,
            "jumlah" => $request->bhp_jumlah,
        ]);

        session()->flash("mainSuccess", "Bhp berhasil disimpan!");
        return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
    }

    public function deleteBhp(Request $request) {
        $polivisitID = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $bhpInstance = Bhp::find($request->bhp_id);

        if ($polivisitID != $bhpInstance->id_polivisit) {
            abort(403);
        } else {
            $bhpInstance->delete();

            session()->flash("mainSuccess", "Bhp berhasil dihapus!");
            return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
        }
    }

    public function saveObat(Request $request) {
        $id_polivisit = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $hargaObat = RefObat::getHargaByID($request->obat);

        Obat::create([
            "id_polivisit" => $id_polivisit,
            "id_obat" => $request->obat,
            "harga" => $hargaObat,
            "jumlah" => $request->obat_jumlah,
        ]);

        session()->flash("mainSuccess", "Obat berhasil disimpan!");
        return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
    }

    public function deleteObat(Request $request) {
        $polivisitID = Reservation::getPolivisitInstanceByCode($request->kode_reservasi)->id;
        $obatInstance = Obat::find($request->obat_id);

        if ($polivisitID != $obatInstance->id_polivisit) {
            abort(403);
        } else {
            $obatInstance->delete();

            session()->flash("mainSuccess", "Obat berhasil dihapus!");
            return redirect(route('kunjunganpoliindividual', $request->kode_reservasi));
        }
    }
}
