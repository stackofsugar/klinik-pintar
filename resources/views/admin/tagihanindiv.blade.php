{{-- {{ dd($polivisitInstance) }} --}}
@extends('layouts.admin')
@section('tagihan-active', 'active')

@section('content')
    <div>
        <h2>
            <a class="link-warning" href="{{ $returnURL }}"><i class="bi bi-caret-left me-1"></i></a>Detail Tagihan
        </h2>
        <hr>
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-12 mb-4">
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
                    </div>
                    <hr>
                    @if ($polivisitInstance->sudah_dibayar == true)
                        <span>Status Tagihan: <span class="badge bg-success">sudah dibayar</span></span>
                    @else
                        <span>Status Tagihan: <span class="badge bg-danger">belum dibayar</span></span>
                    @endif
                </div>
            </div>
            @if (session('tagihanSuccess'))
                <div class="alert alert-success alert-dismissible fade show mt-3">
                    {{ session('tagihanSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-xxl-8 col-xl-9 col-lg-10 col-12">
            <h4>Rekap Tagihan</h4>
            <hr>
            <div class="col-lg-7 col-sm-10 col-12">
                <div class="mb-2">
                    <h5>Pendaftaran Poli</h5>
                    <div class="d-flex justify-content-between">
                        <div>Poli {{ $namaPoli }}</div>
                        <div>Rp. {{ $polivisitInstance->cost }}</div>
                    </div>
                </div>
                <div class="mb-3">
                    @php
                        $totalBhp = 0;
                        $totalTindakan = 0;
                        $totalObat = 0;
                    @endphp
                    <h5>Biaya Poli</h5>
                    <div class="fw-bold">Bahan Habis Pakai</div>
                    @foreach ($savedBhp as $item)
                        <div class="d-flex justify-content-between">
                            <div>{{ ucwords($item->nama) }}</div>
                            <div>{{ $item->jumlah }} * Rp. {{ $item->harga }} = Rp.
                                {{ $item->harga * $item->jumlah }}</div>
                        </div>
                        @php
                            $totalBhp += $item->harga * $item->jumlah;
                        @endphp
                    @endforeach
                    <div class="fw-bold">Tindakan</div>
                    @foreach ($savedTindakan as $item)
                        <div class="d-flex justify-content-between">
                            <div>{{ ucwords($item->nama) }}</div>
                            <div>{{ $item->jumlah }} * Rp. {{ $item->harga }} = Rp.
                                {{ $item->harga * $item->jumlah }}</div>
                        </div>
                        @php
                            $totalTindakan += $item->harga * $item->jumlah;
                        @endphp
                    @endforeach
                    <div class="fw-bold">Obat</div>
                    @foreach ($savedObat as $item)
                        <div class="d-flex justify-content-between">
                            <div>{{ $item->nama }}</div>
                            <div>{{ $item->jumlah }} * Rp. {{ $item->harga }} = Rp.
                                {{ $item->harga * $item->jumlah }}</div>
                        </div>
                        @php
                            $totalObat += $item->harga * $item->jumlah;
                        @endphp
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <h4>Total Tagihan</h4>
                    <h4>Rp. {{ $totalBhp + $totalTindakan + $totalObat }}</h4>
                </div>
            </div>
            <hr>
            <div>
                @if ($polivisitInstance->sudah_dibayar == true)
                @else
                    <form action="{{ route('saveTagihan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $reserveInstance->reservation_code }}">
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" id="bayar_confirm" name="bayar_confirm">
                            <label for="bayar_confirm" class="form-check-label">Saya yakin ingin membayar</label>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-credit-card"></i> Bayar Tagihan
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <div style="min-height: 300px"></div>
    </div>

@endsection
