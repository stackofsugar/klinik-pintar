@extends('layouts.main')

@section('title', 'Tentang')
@section('tentang-active', 'active')

@section('content')
    <div class="container">
        <div>
            <h1 class="text-center mb-1"><strong>Tentang</strong> Kami</h1>
            <p class="text-center text-muted mb-4">Profil <strong>KlinikPintar</strong></p>
        </div>
        {{-- SECTION Profile --}}
        <div class="row mb-5">
            <div class="d-flex col-xxl-3 col-lg-5 col-md-5 col-12 mb-3 mb-md-0 text-end">
                <img src="./assets/brand-logo-about.svg" class="img-fluid w-100">
            </div>
            <div class="col">
                <h4 class="text-muted">Kesehatan Anda Adalah Prioritas Kami</h4>
                <p>
                    <strong>KlinikPintar</strong> merupakan klinik kesehatan yang paling terpercaya di Kota
                    Surakarta, memiliki pengalaman lebih dari 1 hari dengan sertifikasi klinik A++.
                    <strong>KlinikPintar</strong> juga dilengkapi fasilitas modern seperti MRI dan CT-scan untuk
                    menunjang kesehatan anda. <strong>KlinikPintar</strong> memiliki lebih dari 100 dokter
                    berpengalaman yang tersebar di 10 poli.
                </p>
                <h5><strong>Visi</strong></h5>
                <p>
                    Menjadi <strong>klinik pelayanan kesehatan terbaik</strong> dengan mengedepankan profesionalisme,
                    keilmuan dan orientasi
                    pasien
                </p>
                <h5><strong>Misi</strong></h5>
                <p class="mb-0">
                    1. Melaksanakan kerjasama tim yang professional, dinamis dan berdedikasi untuk memberikan hasil terbaik
                    untuk pasien.
                </p>
                <p>
                    2. Menyediakan jasa layanan kesehatan sesuai dengan kebutuhan pasien.
                </p>
            </div>
        </div>
        {{-- !SECTION Profile --}}

        {{-- SECTION Gallery --}}
        <div>
            <h2 class="text-center mb-1"><strong>Galeri</strong> Kami</h2>
            <p class="text-center text-muted mb-4">Dokumentasi kegiatan dan fasilitas di <strong>KlinikPintar</strong></p>
        </div>
        <div class="mb-5">
            <p class="text-center">Placeholder</p>
        </div>
        {{-- !SECTION Gallery --}}

        {{-- SECTION FAQ --}}
        <div class="container">
            <div>
                <h2 class="text-center mb-1">Frequently <strong>Asked</strong> Question</h2>
                <p class="text-center text-muted">Pertanyaan yang sering kami dapatkan</p>
            </div>
            <div class="accordion col-lg-6 offset-lg-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            Mengapa harus KlinikPintar?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Karena <strong>KlinikPintar</strong> merupakan klinik kesehatan yang paling terpercaya di Kota
                            Surakarta, memiliki pengalaman lebih dari 1 hari dengan sertifikasi klinik A++.
                            <strong>KlinikPintar</strong> juga dilengkapi fasilitas modern seperti MRI dan CT-scan untuk
                            menunjang kesehatan anda. <strong>KlinikPintar</strong> juga memiliki lebih dari 100 dokter
                            berpengalaman yang tersebar di 10 poli.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo">
                            Bagaimana cara reservasi Poli Umum online?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Anda dapat reservasi waktu Poli Umum anda dengan memasuki menu <strong>Reservasi</strong> pada
                            bar
                            navigasi. Anda akan dipandu untuk mendaftar sebagai pasien <strong>KlinikPintar</strong> atau
                            login
                            jika belum. Setelah itu, anda akan diarahkan untuk mengisi tanggal rencana kedatangan pada
                            formulir
                            reservasi. Setelah itu, pastikan anda datang ke <strong>KlinikPintar</strong> tepat waktu untuk
                            mendapatkan perawatan pada Poli Umum kami!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree">
                            Bagaimana alur rujuk Poli?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Di <strong>KlinikPintar</strong>, kami sangat berorientasi pada kesehatan Anda. Oleh karena itu,
                            jika pada kedatangan Poli Umum kami menilai butuh dilakukan tindakan lebih lanjut, anda akan
                            dirujuk
                            ke 10 Poli Bagian kami. Prosesnya pun sangat mudah, Anda hanya harus mengikuti arahan dokter
                            umum
                            yang merawat Anda di Poli Umum dan sistem <strong>KlinikPintar</strong> akan melakukan
                            pekerjaannya
                            untuk Anda!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- !SECTION FAQ --}}
    </div>
@endsection
