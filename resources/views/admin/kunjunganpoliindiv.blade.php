{{-- {{ dd($savedObat) }} --}}
@extends('layouts.admin')
@section('kunjunganpoli-active', 'active')

@section('content')
    <div>
        <h2>
            <a class="link-warning" href="{{ $returnURL }}"><i class="bi bi-caret-left me-1"></i></a>Item Kunjungan Poli
        </h2>
        <hr>
        <div class="">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-12">
                @if (session('mainSuccess'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('mainSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('mainError'))
                    <div class="alert alert-danger">
                        {{ session('mainError') }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="text-muted">{{ $kodeReservasi }}</h4>
                        <div>Nama Pasien: {{ $namaPasien }}</div>
                        <div>Nama Dokter: {{ $namaDokter }}</div>
                        <div>Poli: {{ $namaPoli }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-xl-10 col-lg-11 col-12">
                <div class="mb-4">
                    <h2>Tindakan</h2>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#tindakanModal"><i class="bi bi-plus-circle me-1"></i> Tambah
                        Tindakan</button>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kuantitas</th>
                                <th>Aksi</th>
                            </thead>
                            @if ($savedTindakan != null)
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($savedTindakan as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ ucwords($item->nama) }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>
                                                <form action="{{ route('deleteTindakan') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="tindakan_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="kode_reservasi"
                                                        value="{{ $kodeReservasi }}">
                                                    <button type="submit" class="btn btn-danger btn-sm px-1 py-0">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="mb-4">
                    <h2>Bahan Habis Pakai</h2>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#bhpModal"><i class="bi bi-plus-circle me-1"></i> Tambah
                        BHP</button>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kuantitas</th>
                                <th>Aksi</th>
                            </thead>
                            @if ($savedBhp != null)
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($savedBhp as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ ucwords($item->nama) }}</td>
                                            <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                                            <td>
                                                <form action="{{ route('deleteBhp') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="bhp_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="kode_reservasi"
                                                        value="{{ $kodeReservasi }}">
                                                    <button type="submit" class="btn btn-danger btn-sm px-1 py-0">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="mb-4">
                    <h2>Obat</h2>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#obatModal"><i class="bi bi-plus-circle me-1"></i> Resepkan
                        Obat</button>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kuantitas</th>
                                <th>Aksi</th>
                            </thead>
                            @if ($savedObat != null)
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($savedObat as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                                            <td>
                                                <form action="{{ route('deleteObat') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="obat_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="kode_reservasi"
                                                        value="{{ $kodeReservasi }}">
                                                    <button type="submit" class="btn btn-danger btn-sm px-1 py-0">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="">
                    <h2>Diagnosis Primer</h2>
                    <label for="cari-diagnosis" class="form-label">Cari Diagnosis</label>
                    <div class="col-6">
                        <form action="{{ route('kunjunganpoliindividual', $kodeReservasi) }}" method="GET">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="cari-diagnosis" id="cari-diagnosis"
                                    placeholder="Cari diagnosis disini" value="{{ old('cari-diagnosis') }}" required>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <form action="{{ route('kunjunganpoliindividual', $kodeReservasi) }}" method="POST">
                    @csrf
                    <div class="col-6 mb-4">
                        <select class="form-select" name="diagnosis" id="diagnosis" required>
                            @if ($haveFailedSearch)
                                <option value="" selected>Diagnosis Tidak Ditemukan!</option>
                            @elseif ($listPenyakit == null)
                                <option value="" selected>Cari Diagnosis di Atas</option>
                            @else
                                @foreach ($listPenyakit as $penyakit)
                                    <option value="{{ $penyakit->id }}">{{ ucwords($penyakit->nama) }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-4">
                        <h2>Aksi Selanjutnya</h2>
                        <div class="form-check mb-2">
                            <input type="checkbox" id="save_prompt" name="save_prompt" class="form-check-input"
                                onclick="checkTutupKunjungan()">
                            <label for="save_prompt" class="form-check-label">Tutup Kunjungan Ini</label>
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-clipboard-check me-1"
                                id="simpan-logo"></i>
                            <span id="simpan-kunjungan-text">Simpan Kunjungan</span>
                        </button>
                </form>
            </div>
        </div>
    </div>
    <div style="min-height: 500px"></div>
    </div>
    <div class="modal fade" id="tindakanModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('saveTindakan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_reservasi" value="{{ $kodeReservasi }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tindakanModalLabel">Tambah Tindakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tindakan" class="form-label">Pilih Tindakan</label>
                            <select name="tindakan" id="tindakan" class="form-select" required
                                onchange="updateSatuanTindakan()">
                                <option value="" selected>Pilih Tindakan Anda</option>
                                @foreach ($listTindakan as $tindakan)
                                    <option value="{{ $tindakan->id }}">
                                        {{ ucwords($tindakan->nama) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tindakan_jumlah" class="form-label">Jumlah Tindakan</label>
                            <input type="number" class="form-control" id="tindakan_jumlah" name="tindakan_jumlah"
                                min="1" oninput="updateTotalTindakan()" required>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-3 mb-sm-0">
                                <label for="" class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="tindakan-harga-satuan">0</span></span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label">Harga Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="tindakan-harga-total">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Tindakan</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bhpModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('saveBhp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_reservasi" value="{{ $kodeReservasi }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bhpModalLabel">Tambah BHP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bhp" class="form-label">Pilih BHP</label>
                            <select name="bhp" id="bhp" class="form-select" required
                                onchange="updateSatuanBHP()">
                                <option value="" selected>Pilih BHP Anda</option>
                                @foreach ($listBHP as $bhp)
                                    <option value="{{ $bhp->id }}">
                                        {{ ucwords($bhp->nama) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bhp_jumlah" class="form-label">Jumlah BHP</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="bhp_jumlah" name="bhp_jumlah"
                                    min="1" oninput="updateTotalBHP()" required>
                                <span class="input-group-text" id="bhp-satuan"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-3 mb-sm-0">
                                <label for="" class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="bhp-harga-satuan">0</span></span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label">Harga Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="bhp-harga-total">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah BHP</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="obatModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('saveObat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_reservasi" value="{{ $kodeReservasi }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="obatModalLabel">Resepkan Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="obat" class="form-label">Pilih Obat</label>
                            <select name="obat" id="obat" class="form-select" required
                                onchange="updateSatuanObat()">
                                <option value="" selected>Pilih Obat Anda</option>
                                @foreach ($listObat as $obat)
                                    <option value="{{ $obat->id }}">
                                        {{ $obat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="obat_jumlah" class="form-label">Jumlah Obat</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="obat_jumlah" name="obat_jumlah"
                                    min="1" oninput="updateTotalObat()" required>
                                <span class="input-group-text" id="obat-satuan"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm mb-3 mb-sm-0">
                                <label for="" class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="obat-harga-satuan">0</span></span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="" class="form-label">Harga Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp. <span class="ms-1"
                                            id="obat-harga-total">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Obat</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var listTindakan = {!! json_encode($listTindakan) !!};
        var listBHP = {!! json_encode($listBHP) !!};
        var listObat = {!! json_encode($listObat) !!};
    </script>
    @php
    @endphp
@endsection
