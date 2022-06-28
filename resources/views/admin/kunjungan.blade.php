@extends('layouts.admin')
@section('kunjungan-active', 'active')

@section('content')
    <div>
        <h2>Kunjungan</h2>
        <hr>
        @if (session('reserveSuccess'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('reserveSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('reserveError'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('reserveError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mb-3 col-xl-4 col-lg-5 col-sm-6 col-12">
            <label for="reserve_code" class="form-label">Masukkan kode reservasi</label>
            <form action="{{ route('kunjungan') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="reserve_code" id="reserve_code" class="form-control"
                        value="{{ old('reserve_code') }}" required>
                    <button class="btn btn-outline-primary" type="submit">Cari <i class="bi bi-search ms-1"></i></button>
                </div>
            </form>
        </div>

        @if (session('reserveInstance') != null)
            <div style="min-height: 1000px">
                @php
                    $reserveInstance = session('reserveInstance');
                    
                    $reserveDate = new DateTime($reserveInstance->planned_arrival);
                    $reserveDate->setTime(0, 0, 0);
                    $todayDate = new DateTime('today');
                    $diff = $todayDate->diff($reserveDate);
                    $diffDays = (int) $diff->format('%R%a');
                    
                    $hasDateError = false;
                    $dateErrorMessage = '';
                    if ($diffDays != 0) {
                        $hasDateError = true;
                        if ($diffDays < 0) {
                            $dateErrorMessage = 'Tanggal kedatangan sudah lewat, hanya lanjutkan jika ingin override!';
                        } else {
                            $dateErrorMessage = 'Tanggal kedatangan bukan hari ini, hanya lanjutkan jika ingin override!';
                        }
                    }
                    
                    $dateString = $reserveDate->format('j F Y');
                    
                @endphp
                <div class="col-xxl-6 col-xl-7 col-lg-8 col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $reserveInstance->reservation_code }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Reservasi</h6>
                            <div class="">
                                <ul class="list-unstyled mb-0">
                                    <li>Nama Pasien: {{ session('namaPasien') }}</li>
                                    <li>Nama Dokter: {{ session('namaDokter') }}</li>
                                    <li>Poli: {{ session('namaPoli') }}</li>
                                    <li>Rencana Kedatangan: {{ $dateString }}</li>
                                </ul>
                            </div>
                            <hr>
                            <h6 class="card-subtitle mb-2 text-muted">Aksi</h6>
                            <div class="mb-0">
                                <form action="{{ route('kunjungan') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="reserve_code"
                                        value="{{ $reserveInstance->reservation_code }}">
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3 me-1"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h3 class="mb-3">Pemeriksaan Kunjungan</h3>
                        @if ($hasDateError == true)
                            <div class="mb-3 alert alert-danger">
                                <h5 class="alert-heading fw-bold">Perhatian!</h5>
                                {{ $dateErrorMessage }}
                            </div>
                        @endif
                        <form action="{{ route('kunjungan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reserve_code" value="{{ $reserveInstance->reservation_code }}">
                            <div class="mb-3">
                                <label for="bp_sistole" class="form-label">Tekanan Darah (sistole / diastole)</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" name="bp_sistole" id="bp_sistole">
                                    <span class="input-group-text">mmHg</span>
                                    <span class="input-group-text">/</span>
                                    <input class="form-control" type="number" name="bp_diastole" id="bp_diastole">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="heart_rate" class="form-label">Denyut Nadi</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" name="heart_rate" id="heart_rate">
                                    <span class="input-group-text">denyut/menit</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="date-of-birth" class="form-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="date-of-birth" id="date-of-birth"
                                    value="{{ session('ttlPasien') }}">
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Simpan Pemeriksaan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @php
    session()->forget(['reserveSuccess', 'reserveInstance', 'namaPasien', 'ttlPasien', 'namaDokter', 'namaPoli', 'reserveError']);
    @endphp
@endsection
