@extends('layouts.main')

@section('title', 'Profil Pasien')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="mb-1">Buat Profil <strong>Pasien</strong></h1>
            <p class="text-muted mb-0">Untuk melanjutkan menjadi pasien <strong>KlinikPintar</strong></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6">
                <form action="/buatprofil/pasien" method="post" class="">
                    @csrf
                    <div class="row d-flex">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input type="text" value="{{ Auth::user()->fullname }}" class="form-control" id="fullname"
                                name="fullname" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">Nomor Induk Kependudukan</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                                value="{{ old('nik') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-12">
                            <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                                id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}" required>
                            @error('place_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-12">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2 text-center">
                            <h4 class="mb-0">Informasi Domisili</h4>
                            <span class="text-muted">Gunakanlah data tempat tinggal anda sekarang, termasuk
                                kos/kontrak.</span>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-sm-6 col-12">
                            <label for="rt" class="form-label">Nomor RT</label>
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt"
                                value="{{ old('rt') }}" required>
                            @error('rt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-sm-6 col-12">
                            <label for="rw" class="form-label">Nomor RW</label>
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw"
                                value="{{ old('rw') }}" required>
                            @error('rw')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6 col-12">
                            <label for="provinsi_id" class="form-label">Provinsi</label>
                            <select name="provinsi_id" id="provinsi_id"
                                class="form-select @error('provinsi_id') is-invalid @enderror"
                                onchange="selectProvinceChange()" required>
                                <option value="0" selected>Pilih Provinsi Anda</option>
                                @foreach ($list_provinsi as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-6 col-12">
                            <label for="kota_id"
                                class="form-label @error('kota_id') is-invalid @enderror">Kota/Kabupaten</label>
                            <select name="kota_id" id="kota_id" class="form-select" required>
                                <option value="0" selected>Pilih Provinsi Anda
                                    Terlebih Dahulu</option>
                            </select>
                            @error('kota_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div><button type="submit" class="btn btn-primary w-100">Kirim</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var list_kota = {!! json_encode($list_kota) !!};
        document.querySelector("form").reset();
    </script>
@endsection
