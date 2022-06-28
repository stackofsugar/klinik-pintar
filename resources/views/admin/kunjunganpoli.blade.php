@extends('layouts.admin')
@section('kunjunganpoli-active', 'active')

@section('content')
    <div>
        <h2>Kunjungan Poli</h2>
        <hr>
        <div class="mb-4 col-xl-4 col-lg-5 col-sm-6 col-12">
            <label for="reservation_code" class="form-label">Cari kunjungan berdasarkan kode reservasi</label>
            <form action="{{ route('kunjunganpoli') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="reservation_code" id="reservation_code" class="form-control"
                        value="{{ old('reservation_code') }}" required>
                    <button class="btn btn-outline-primary" type="submit">Cari <i class="bi bi-search ms-1"></i></button>
                </div>
            </form>
        </div>
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-12">
            @if (session('reserveSuccess'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('reserveSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('reserveError'))
                <div class="alert alert-danger">
                    {{ session('reserveError') }}
                </div>
            @endif
            @if (session('reserveInstance') != null)
                @php
                    $reserveInstance = session('reserveInstance');
                    $statusKunjungan = session('statusKunjungan');
                    
                    $kunjunganDate = new DateTime($reserveInstance->waktu_kunjungan);
                    $kunjunganDateString = $kunjunganDate->format('j F Y, H:i:s');
                    
                    $todayDate = new DateTime('today');
                    $kunjunganDate->setTime(0, 0, 0);
                    $diff = $todayDate->diff($kunjunganDate);
                    $diffDays = (int) $diff->format('%R%a');
                    
                    $periksaAwalTimeError = false;
                    if ($diffDays < 0) {
                        $periksaAwalTimeError = true;
                    }
                @endphp
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $reserveInstance->reservation_code }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Kunjungan</h6>
                        <div class="">
                            <ul class="list-unstyled mb-0">
                                <li>Nama Pasien: {{ session('namaPasien') }}</li>
                                <li>Nama Dokter: {{ session('namaDokter') }}</li>
                                <li>Poli: {{ session('namaPoli') }}</li>
                                <li>Waktu Periksa Awal: {{ $kunjunganDateString }}</li>
                                @if ($periksaAwalTimeError == true)
                                    <li class="fw-bold text-danger">Perhatian! Waktu periksa awal sudah lewat. Lanjutkan
                                        hanya jika ingin override!</li>
                                @endif
                            </ul>
                        </div>
                        <hr>
                        <div>
                            Status Kunjungan:
                            @if ($statusKunjungan == 'belum')
                                <span class="badge bg-warning">belum dibuka</span>
                            @elseif ($statusKunjungan == 'aktif')
                                <span class="badge bg-success">aktif</span>
                            @else
                                <span class="badge bg-danger">sudah ditutup</span>
                            @endif
                        </div>
                        <hr>
                        @if ($statusKunjungan == 'tutup')
                            <span class="fw-bold text-danger">Perhatian! Kunjungan ini sudah ditutup!</span>
                        @else
                            <a type="button" class="btn btn-warning btn-sm"
                                href="{{ route('kunjunganpoli') }}/{{ $reserveInstance->reservation_code }}">Buka
                                Kunjungan
                                Poli <i class="bi bi-forward ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    @php
    session()->forget(['reserveError', 'statusKunjungan', 'reserveSuccess', 'reserveInstance', 'namaPasien', 'namaDokter', 'namaPoli']);
    @endphp
@endsection
