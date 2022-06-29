{{-- {{ dd($list_reservasi) }} --}}
@extends('layouts.main')

@section('title', 'Reservasi')
@section('reservasi-active', 'active')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h1 class="text-center mb-1">Reservasi</h1>
            <p class="text-center text-muted">Jadwalkan kedatangan anda ke <strong>KlinikPintar</strong> di sini!</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5 class="alert-heading fw-bold">Terjadi Kesalahan!</h5>
                <ul class="mb-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('successAlert'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('successAlert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('errorAlert'))
            <div class="alert alert-danger">
                {{ session('errorAlert') }}
            </div>
        @endif
        <div>
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservasiModal"><i
                        class="bi bi-plus-circle me-2"></i>Tambah Reservasi</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th scope="col">Kode</th>
                        <th scope="col">Tanggal Datang</th>
                        <th scope="col">Poli</th>
                        <th scope="col">Dokter</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($list_reservasi as $reservasi)
                            @php
                                $reserveDate = new DateTime($reservasi->planned_arrival);
                                $reserveDate->setTime(0, 0, 0);
                                $todayDate = new DateTime('today');
                                $diff = $todayDate->diff($reserveDate);
                                $diffDays = (int) $diff->format('%R%a');
                                
                                $dateString = $reserveDate->format('j F Y');
                                
                                $statusClass = '';
                                $statusMessage = '';
                                
                                if ($reservasi->is_closed == 1) {
                                    if ($reservasi->sudah_dibayar == true) {
                                        $statusClass = 'badge bg-secondary';
                                        $statusMessage = 'selesai';
                                    } else {
                                        $statusClass = 'badge bg-primary';
                                        $statusMessage = 'ada tagihan';
                                    }
                                } elseif ($reservasi->id_visit != null) {
                                    $statusClass = 'badge bg-success';
                                    $statusMessage = 'aktif';
                                } else {
                                    if ($diffDays < 0) {
                                        $statusClass = 'badge bg-danger';
                                        $statusMessage = 'kedaluwarsa';
                                    } else {
                                        $statusClass = 'badge bg-warning text-dark';
                                        $statusMessage = 'belum datang';
                                    }
                                }
                                
                                $namaPoliBagian = $list_poli[$reservasi->id_poli_bagian];
                                
                                $dokterCollect = collect($list_dokter);
                                $namaDokter = $dokterCollect->where('id', '=', $reservasi->id_dokter)->first()->fullname;
                            @endphp
                            <tr>
                                <td>{{ $reservasi->reservation_code }}</td>
                                <td>{{ $dateString }}</td>
                                <td>{{ $namaPoliBagian }}</td>
                                <td>{{ $namaDokter }}</td>
                                <td><span class="{{ $statusClass }}">{{ $statusMessage }}</span></td>
                                <td>
                                    @if ($reservasi->is_closed == 1)
                                        {{-- <button class="btn btn-success btn-sm px-1 py-0" type="submit"><i
                                                class="bi bi-eye"></i></button> --}}
                                    @elseif ($reservasi->id_visit != null)
                                    @else
                                        <form action="{{ route('reservasi') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="reservation_code"
                                                value="{{ $reservasi->reservation_code }}">
                                            <button class="btn btn-danger btn-sm px-1 py-0" type="submit"><i
                                                    class="bi bi-trash3"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reservasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/reservasi" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buat Reservasi Baru</h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone_num" class="form-label">No. HP</label>
                            <input type="number" class="form-control" id="phone_num" name="phone_num" required>
                        </div>
                        <div class="mb-3">
                            <label for="planned_arrival" class="form-label">Tanggal Rencana Datang</label>
                            <input type="date" class="form-control" id="planned_arrival" name="planned_arrival" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_poli_bagian" class="form-label">Poli Bagian</label>
                            <select name="id_poli_bagian" id="id_poli_bagian" class="form-select"
                                onchange="selectDoctorChange()" required>
                                <option value="" selected>Pilih Poli Anda</option>
                                @foreach ($list_poli as $id => $name)
                                    <option value="{{ $id }}">Poli {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="id_dokter" class="form-label">Dokter</label>
                            <select name="id_dokter" id="id_dokter" class="form-select" required>
                                <option value="" selected>Pilih Dokter Anda</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var list_dokter = {!! json_encode($list_dokter) !!};
    </script>
@endsection
