@extends('layouts.main')

@section('title', 'Buat Profil')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="mb-1">Buat Profil <strong>KlinikPintar</strong></h1>
            <p class="text-muted mb-0">Untuk mendapatkan semua fitur di <strong>KlinikPintar</strong></p>
        </div>
        <div class="text-center mb-3">
            <h4>Pilih jenis profil Anda</h4>
        </div>
        <div class="row justify-content-center g-0">
            <a href="/buatprofil/dokter"
                class="profile-select rounded-start col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 col-xxl-2 border">
                <div class="text-center row g-0 justify-content-center">
                    <div class="col-12" style="font-size: 5rem"><i class="bi bi-heart-pulse"></i></div>
                    <div class="col-12 mb-2 fs-2">Dokter</div>
                </div>
            </a>
            <a href="/buatprofil/pasien"
                class="profile-select rounded-end col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 col-xxl-2 border">
                <div class="text-center row g-0 justify-content-center">
                    <div class="col-12" style="font-size: 5rem"><i class="bi bi-thermometer-high"></i></div>
                    <div class="col-12 mb-2 fs-2">Pasien</div>
                </div>
            </a>
        </div>
    </div>
@endsection
