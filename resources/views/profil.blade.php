@inject('patient', 'App\Models\Patient')
@inject('doctor', 'App\Models\Doctor')
@extends('layouts.main')
@section('title', 'Profil')
@section('content')
    <div class="container">
        <div class="mb-4">
            <h2 class="mb-1">Halo, <strong>{{ Auth::user()->fullname }}</strong>!</h2>
            <h5 class="text-muted">&commat;{{ Auth::user()->username }}</h5>
            @can('patient')
                <div class="mb-10 fs-5">
                    No. Rekam Medis: {{ $patient->user()->no_rm }}
                </div>
            @endcan
            <div class="mb-2">
                @can('hasProfile')
                    @can('doctor.inactive')
                        <span class="badge bg-danger">Dokter Nonaktif</span>
                    @endcan
                    @can('admin')
                        <span class="badge bg-success">Administrator</span>
                        @can('admin.cashier')
                            <span class="badge bg-success">Kasir</span>
                        @endcan
                        @can('admin.poli')
                            <span class="badge bg-success">Poli</span>
                        @endcan
                        @can('admin.god')
                            <span class="badge bg-warning">Pemilik</span>
                        @endcan
                    @endcan
                    @can('patient')
                        <span class="badge bg-success">Pasien</span>
                    @endcan
                    @can('doctor.active')
                        <span class="badge bg-success">Dokter</span>
                    @endcan
                @endcan
            </div>
            <div>
                @cannot('hasProfile')
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading mb-1">Anda belum membuat profil lanjutan!</h4>
                        <p class="mb-0">Lengkapi profil <strong>KlinikPintar</strong> anda <a class="text-reset"
                                href="/buatprofil">di sini.</a></p>
                    </div>
                @endcannot
                @can('doctor.inactive')
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading mb-1">Status Dokter anda belum diaktifkan!</h4>
                        <p class="mb-0">Segera hubungi administrator untuk aktivasi status Dokter anda!</p>
                    </div>
                @endcan
            </div>
        </div>
        <div class="mb-4">
            <div class="row g-0 mb-2">
                <div class="col-12" style="border: 1px solid #c2c2c2; border-radius: 0.5rem">
                    <div class="mt-2 mx-3 ">
                        <h4 class="mb-1">Profil Akun</h4>
                        <p class="text-muted mb-0">Profil akun <strong>KlinikPintar</strong> anda</p>
                    </div>
                    <hr class="mb-0 mt-2">
                    <div>
                        <x-profile.entry ptype="1" key="Nama" fieldname="Nama" :value="Auth::user()->fullname" havebreak="1" />
                        <x-profile.entry ptype="1" key="Username" fieldname="Username" :value="Auth::user()->username"
                            havebreak="1" />
                        <x-profile.entry ptype="1" key="Email" fieldname="Email" :value="Auth::user()->email" havebreak="1" />
                        <x-profile.entry ptype="1" key="Password" fieldname="Password Baru" value="*****"
                            havebreak="0" />
                    </div>
                </div>
            </div>
        </div>

        @canany(['patient', 'doctor.active'])
            <div class="mb-4">
                <div class="row g-0 mb-2">
                    <div class="col-12" style="border: 1px solid #c2c2c2; border-radius: 0.5rem">
                        <div class="mt-2 mx-3 ">
                            <h4 class="mb-1">
                                Profil
                                @can('doctor.active')
                                    Dokter
                                @elsecan('patient')
                                    Pasien
                                @endcan
                            </h4>
                        </div>
                        <hr class="mb-0 mt-2">
                        <div>
                            @can('doctor.active')
                                <x-profile.entry ptype="2" key="No. SIP" :value="$doctor->user()->sip_num" fieldname="No. SIP"
                                    havebreak="1" />
                                <x-profile.entry ptype="2" key="Poli Bagian" :value="$doctor->getPoli()" fieldname="Poli Bagian"
                                    havebreak="1" />
                                <x-profile.entry ptype="2" key="No. Handphone" :value="$doctor->user()->phone_num" fieldname="No. Handphone"
                                    havebreak="1" />
                            @elsecan('patient')
                                <x-profile.entry ptype="2" key="NIK" :value="$patient->user()->nik" fieldname="NIK" havebreak="1" />
                                <x-profile.entry ptype="2" key="Tempat Lahir" :value="$patient->user()->place_of_birth" fieldname="Tempat Lahir"
                                    havebreak="1" />
                                <x-profile.entry ptype="2" key="Tanggal Lahir" :value="$patient->user()->date_of_birth" fieldname="Tanggal Lahir"
                                    havebreak="1" />
                                <x-profile.entry ptype="2" key="Alamat" :value="$patient->user()->address" fieldname="Alamat"
                                    havebreak="1" />
                                <x-profile.entry ptype="2" key="Provinsi" value="" fieldname="Provinsi" havebreak="1" />
                                <x-profile.entry ptype="2" key="Kota" value="" fieldname="Kota" havebreak="1" />
                                <x-profile.entry ptype="2" key="RT" :value="$patient->user()->rt" fieldname="RT" havebreak="1" />
                                <x-profile.entry ptype="2" key="RW" :value="$patient->user()->rw" fieldname="RW" havebreak="0" />
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endcanany

        {{-- Profile edit modal --}}
        <div class="modal fade" id="profile-edit-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Profil</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid g-0">
                            <div class="alert alert-danger d-none" role="alert">
                                <div class="fw-bold" id="alert-header">Terjadi kebenaran</div>
                                <div id="alert-body">Kebenarannya adalah saya suka dengan anda</div>
                            </div>
                            <div class="row g-0">
                                <div class="mb-3" id="modal-input-group">
                                    <label for="" class="form-label"></label>
                                    <input type="text" class="main-input form-control" id="" name=""
                                        required>
                                    <div class="input-group d-none">
                                        <input type="password" class="form-control" id="password-baru"
                                            name="password-baru" required>
                                        <span id="passwordPeek" class="input-group-text"
                                            onmousedown="mousedownPasswordPeek(this)"
                                            onmouseup="mouseupPasswordPeek(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <div class="modal-error d-none form-text text-danger fw-bold"><span
                                            id="attr-name">Atribut</span> ini sudah
                                        dipilih!</div>
                                    <div class="modal-error modal-error-custom d-none form-text text-danger fw-bold">
                                        Masukan
                                        tidak boleh kosong!</div>
                                </div>
                                <div id="modal-pass-input">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <span id="passwordPeek" class="input-group-text"
                                            onmousedown="mousedownPasswordPeek(this)"
                                            onmouseup="mouseupPasswordPeek(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </span>
                                    </div>
                                    <div class="modal-error d-none form-text text-danger fw-bold mb-0">Password anda tidak
                                        sesuai!</div>
                                    <div class="form-text">Konfirmasikan password anda untuk membuat perubahan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn btn-primary nodrag" id="modal-submit-button">
                            <span id="button-spinner" class="spinner-border spinner-border-sm d-none"></span>
                            <span>Kirim</span>
                        </a>
                        <button type="button" class="btn btn-danger" id="modal-dismiss-button"
                            data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var csrfToken = "{{ csrf_token() }}";
        var username = "{{ Auth::user()->username }}";
        var apiToken = "{{ $apiToken }}";
    </script>
@endsection
