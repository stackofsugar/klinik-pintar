@extends('layouts.main')

@section('title', 'Profil Dokter')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="mb-1">Buat Profil <strong>Dokter</strong></h1>
            <p class="text-muted mb-0">Untuk melanjutkan menjadi dokter <strong>KlinikPintar</strong></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6">
                <form action="/buatprofil/dokter" method="post" class="">
                    @csrf
                    <div class="row d-flex">
                        <div class="mb-2">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nama Lengkap</label>
                                <input type="text" value="{{ Auth::user()->fullname }}" class="form-control"
                                    id="fullname" name="fullname" disabled required>
                            </div>
                            <div class="mb-3">
                                <label for="sip_num" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Nomor Surat Izin Praktek">Nomor SIP</label>
                                <input type="number" class="form-control @error('sip_num') is-invalid @enderror"
                                    id="sip_num" name="sip_num" value="{{ old('sip_num') }}" required>
                                @error('sip_num')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="poli_bagian_id" class="form-label">Poli Bagian</label>
                                <select name="poli_bagian_id" id="poli_bagian_id"
                                    class="form-select @error('poli_bagian_id') is-invalid @enderror" required>
                                    <option value="0" selected>Pilih Poli Anda</option>
                                    @foreach ($list_poli as $id => $name)
                                        @if ($id == old('poli_bagian_id'))
                                            <option value="{{ $id }}" selected>Poli {{ $name }}</option>
                                        @else
                                            <option value="{{ $id }}">Poli {{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('poli_bagian_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone_num" class="form-label">Nomor HP Aktif</label>
                                <input type="number" class="form-control @error('phone_num') is-invalid @enderror"
                                    id="phone_num" name="phone_num" value="{{ old('phone_num') }}" required>
                                @error('phone_num')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div><button type="submit" class="btn btn-primary w-100">Kirim</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
