{{-- {{ dd($polivisitInstance) }} --}}
@extends('layouts.admin')
@section('tagihan-active', 'active')

@section('content')
    <div>
        <h2>Tagihan</h2>
        <hr>
        <div class="mb-4 col-xl-4 col-lg-5 col-sm-6 col-12">
            <label for="reservation_code" class="form-label">Cari tagihan berdasarkan kode reservasi</label>
            <form action="{{ route('adminTagihan') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="reservation_code" id="reservation_code" class="form-control"
                        value="{{ old('reservation_code') }}" required>
                    <button class="btn btn-outline-primary" type="submit">Cari <i class="bi bi-search ms-1"></i></button>
                </div>
            </form>
        </div>
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-12">
            @isset($tagihanSuccess)
                <div class="alert alert-success alert-dismissible fade show">
                    {{ $tagihanSuccess }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endisset
            @isset($tagihanError)
                <div class="alert alert-danger">
                    {{ $tagihanError }}
                </div>
            @endisset
            @isset($reserveInstance)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $reserveInstance->reservation_code }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Tagihan</h6>
                        <div>
                            <ul class="list-unstyled mb-0">
                                <li>Nama Pasien: {{ $patientFullname }}</li>
                                <li>Nama Poli: {{ $namaPoli }}</li>
                                <li>Nama Dokter: {{ $doctorFullname }}</li>
                            </ul>
                            <hr>
                            @if ($polivisitInstance->sudah_dibayar == true)
                                <span>Status Tagihan: <span class="badge bg-success">sudah dibayar</span></span>
                            @else
                                <span>Status Tagihan: <span class="badge bg-danger">belum dibayar</span></span>
                            @endif
                            <hr>
                            <a type="button" class="btn btn-sm btn-warning"
                                href="{{ route('adminIndividualTagihan', $reserveInstance->reservation_code) }}">
                                Lihat Tagihan <i class="bi bi-forward"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>

@endsection
