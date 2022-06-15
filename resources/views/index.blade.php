@extends('layouts.main')

@section('title', 'Beranda')
@section('beranda-active', 'active')

@section('content')
    {{-- SECTION Bootstrap Carousel --}}
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel"
        style="margin-top: -1.7rem">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                class="active"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <picture>
                    <source class="d-block w-100" media="(min-width: 768px)" srcset="./assets/front-carousel/1.jpg">
                    <img class="d-block w-100" src="./assets/front-carousel/1-lg.jpg">
                </picture>
                <div class="carousel-overlay-container d-flex align-items-end flex-column">
                    <p class="carousel-overlay-heading mb-0">Klinik Pintar</p>
                    <p class="carousel-overlay-content text-end">Klinik kesehatan terpercaya andalan Anda</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <picture>
                    <source class="d-block w-100" media="(min-width: 768px)" srcset="./assets/front-carousel/2.jpg">
                    <img class="d-block w-100" src="./assets/front-carousel/2-lg.jpg">
                </picture>
                <div class="carousel-overlay-container d-flex align-items-end flex-column">
                    <p class="carousel-overlay-heading mb-0">Poliklinik</p>
                    <p class="carousel-overlay-content text-end mb-0">Dilengkapi 20 poli, mulai dari Poli Gigi,</p>
                    <p class="carousel-overlay-content text-end">Obgyn, hingga Anak</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <picture>
                    <source class="d-block w-100" media="(min-width: 768px)" srcset="./assets/front-carousel/3.jpg">
                    <img class="d-block w-100" src="./assets/front-carousel/3-lg.jpg">
                </picture>
                <div class="carousel-overlay-container d-flex align-items-end flex-column">
                    <p class="carousel-overlay-heading mb-0">Reservasi Online</p>
                    <p class="carousel-overlay-content text-end">Fitur reservasi online mempermudah proses pelayanan</p>
                    <a href="#!" class="btn btn-sm btn-light">Reservasi Sekarang!</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- !SECTION Bootstrap Carousel --}}

    {{-- SECTION Important Infos Card --}}
    <div class="container mb-5">
        <div class="row justify-content-center">
            <h2 class="text-center mb-1">Jadwal <strong>Pelayanan</strong></h2>
            <p class="text-center text-muted mb-3">Selalu di sisi Anda</p>
            <div class="card card-front-info bg-brand-lightblue col-md-6">
                <div class="card-body">
                    <div class="mb-1">
                        <i class="bi bi-clock fs-1 pb-1"></i>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-2">Jam Pelayanan</h3>
                        <p class="ms-2 mb-2">(WIB)</p>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-fill justify-content-between">
                            <div>Senin - Kamis</div>
                            <div>08.00 - 17.00</div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex flex-fill justify-content-between">
                            <div>Jumat</div>
                            <div>07.30 - 17.00</div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex flex-fill justify-content-between">
                            <div>Senin - Kamis</div>
                            <div>08.00 - 15.00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-front-info bg-brand-blue col-md-6">
                <div class="card-body">
                    <div class="mb-1">
                        <i class="bi bi-bandaid fs-1"></i>
                    </div>
                    <h3>Pendaftaran 24 Jam</h3>
                    Pendaftaran reservasi poli umum <strong>24 jam x 7 hari</strong> (kecuali maintenance) melalui website
                    KlinikPintar
                </div>
            </div>
        </div>
    </div>
    {{-- !SECTION Important Infos Card --}}

    {{-- SECTION Services Information --}}
    <div class="container mb-3">
        <h2 class="text-center mb-1"><strong>Pelayanan</strong> Kami</h2>
        <p class="text-center text-muted">Kami menyediakan pelayanan yang terbaik untuk anda</p>
        <div class="slick-front">
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/reservasi.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Reservasi</h5>
                    <p class="card-text">Reservasi Poli Umum online melalui <strong>website KlinikPintar</strong></p>
                </div>
            </div>
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/pembelian-obat.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Pembelian Obat</h5>
                    <p class="card-text">Melayani <strong>pembelian obat</strong> OTC atau dengan resep dokter</p>
                </div>
            </div>
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/poli.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Poli</h5>
                    <p class="card-text">Terdapat <strong> lebih dari 10 poli</strong> untuk melayani segala keluhan
                        kesehatan anda</p>
                </div>
            </div>
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/rm-digital.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Rekam Medis Digital</h5>
                    <p class="card-text">KlinikPintar adalah klinik pertama di Indonesia yang menggunakan <strong>Rekam
                            Medis Digital</strong></p>
                </div>
            </div>
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/fasilitas-kesehatan.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Fasilitas Kesehatan</h5>
                    <p class="card-text">Fasilitas dan peralatan penunjang kesehatan yang terbaru dan terbaik</p>
                </div>
            </div>
            <div class="card slick-front-item">
                <img src="./assets/front-features-carousel/tenaga-kompeten.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Tenaga Kompeten</h5>
                    <p class="card-text">Dokter, perawat, dan staff yang kompeten dan berpengalaman tinggi.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- !SECTION Services Information --}}

    {{-- SECTION Testimony --}}
    <div class="mb-5">
        <div class="container">
            <h2 class="text-center mb-1"><strong>Kata</strong> Mereka</h2>
            <p class="text-center text-muted">Apa kata pasien kami tentang kami</p>
        </div>
        <div class="testimonial-container py-3">
            <div class="container">
                <div class="slick-testimonials">
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/1.jpg" class="testimonial-card-image">
                            <h5 class="card-title">Mike Varshavski</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Pensiunan</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1">Banyak terdapat poli dan semua staff ramah, sehingga saya nyaman untuk
                                kontrol disini.</p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/2.jpg" class="testimonial-card-image">
                            <h5 class="card-title">Anna Mariana</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Karyawan Swasta</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1">Saya kurang paham teknologi, namun sistem
                                <strong>KlinikPintar</strong> mudah dipahami sehingga saya dapat reservasi sendiri
                            </p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/3.jpg" class="testimonial-card-image">
                            <h5 class="card-title">John Hopkins</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Pelajar</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1">Aku selalu memilih <strong>KlinikPintar</strong> ketika ibuku
                                bertanya ingin checkup dimana</p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/4.jpg" class="testimonial-card-image">
                            <h5 class="card-title">Rajeev Karim</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Enterpreneur</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1"><strong>KlinikPintar</strong> satu-satunya klinik di kota yang
                                menawarkan kecepatan pelayanan tak tertandingi.</p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/5.jpg" class="testimonial-card-image">
                            <h5 class="card-title">Maria Goretti</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Ibu</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1">Saya selalu percaya <strong>KlinikPintar</strong> untuk memberikan
                                vaksinasi rutin bagi anak balita saya.</p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                    <div class="card testimonial-card text-center">
                        <div class="card-body">
                            <img src="./assets/avatar/dog.jpg" class="testimonial-card-image">
                            <h5 class="card-title">Doggie</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Anjing sedang minum</h6>
                            <i class="bi bi-quote"></i>
                            <p class="card-text mb-1">Schlop schlop schlop schlop schlop schlop schlop schlop schlop schlop
                                schlop schlop schlop schlop schlop.</p>
                            <i class="bi bi-quote"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- !SECTION Testimony --}}

    {{-- SECTION FAQ --}}
    <div class="container">
        <div>
            <h2 class="text-center mb-1">Frequently <strong>Asked</strong> Question</h2>
            <p class="text-center text-muted">Pertanyaan yang sering kami dapatkan</p>
        </div>
        <div class="accordion col-lg-6 offset-lg-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
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
                        Anda dapat reservasi waktu Poli Umum anda dengan memasuki menu <strong>Reservasi</strong> pada bar
                        navigasi. Anda akan dipandu untuk mendaftar sebagai pasien <strong>KlinikPintar</strong> atau login
                        jika belum. Setelah itu, anda akan diarahkan untuk mengisi tanggal rencana kedatangan pada formulir
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
                        jika pada kedatangan Poli Umum kami menilai butuh dilakukan tindakan lebih lanjut, anda akan dirujuk
                        ke 10 Poli Bagian kami. Prosesnya pun sangat mudah, Anda hanya harus mengikuti arahan dokter umum
                        yang merawat Anda di Poli Umum dan sistem <strong>KlinikPintar</strong> akan melakukan pekerjaannya
                        untuk Anda!
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- !SECTION FAQ --}}
@endsection
