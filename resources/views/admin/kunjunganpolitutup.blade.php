@extends('layouts.admin')
@section('kunjunganpoli-active', 'active')

@section('content')
    <div>
        <h2>
            <a class="link-warning" href="{{ $returnURL }}"><i class="bi bi-caret-left me-1"></i></a>Item Kunjungan Poli
        </h2>
        <hr>
        <div class="text-danger">
            <h3 class="mb-1">Perhatian!</h3>
            <h5 class="">Kunjungan ini sudah ditutup dan tidak bisa dimodifikasi lagi!</h5>
            <p class="text-muted">{{ $kodeReservasi }}</p>
        </div>
    </div>
@endsection
