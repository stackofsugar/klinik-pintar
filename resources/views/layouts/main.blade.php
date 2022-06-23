<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Memintarkan Klinik') ∙ KlinikPintar</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="/resources/app.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-brand-lightblue fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand me-0" href="/">
                    <img src="/assets/brand-logo.svg" alt="" height="28px">
                    KlinikPintar
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item px-lg-2">
                            <a class="nav-link @yield('beranda-active')" href="/">Beranda</a>
                        </li>
                        <li class="nav-item px-lg-2">
                            <a class="nav-link @yield('tentang-active')" href="/tentang">Tentang</a>
                        </li>
                        <li class="nav-item px-lg-2">
                            <a class="nav-link @yield('kontak-active')" href="/kontak">Kontak</a>
                        </li>
                        @can('admin')
                            <li class="nav-item px-lg-2">
                                <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                            </li>
                        @endcan
                        @cannot('admin')
                            @cannot('doctor')
                                <li class="nav-item px-lg-2">
                                    <a class="nav-link @yield('reservasi-active')" href="/reservasi">Reservasi</a>
                                </li>
                            @endcannot
                        @endcannot
                    </ul>
                    <span class="d-flex">
                        @auth
                            <div class="dropdown me-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown"
                                    data-bs-toggle="dropdown">
                                    <i class="bi bi-person"></i> ∙ {{ Auth::user()->username }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/profil">Profil</a></li>
                                    @can('patient')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <h6 class="dropdown-header">Menu Pasien</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Rekam Medis</a></li>
                                    @endcan
                                    @can('doctor.active')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <h6 class="dropdown-header">Menu Dokter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Dashboard Dokter</a></li>
                                    @endcan
                                    @can('admin')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <h6 class="dropdown-header">Menu Admin</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="/admin/dashboard">Dashboard Admin</a></li>
                                    @endcan
                                </ul>
                            </div>
                            <a href="/logout" class="btn btn-danger">Keluar</a>
                        @else
                            <a href="/login" class="btn btn-outline-light me-2">Masuk</a>
                            <a href="/register" class="btn btn-outline-light">Daftar</a>
                        @endauth
                    </span>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-4">
        @yield('content')
    </main>
    <footer class="mt-auto">
        <div class="outer-footer bg-brand-blue mt-5">
            <div class="container">
                <div class="row text-light py-4">
                    <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="fs-4 mb-2 fw-bold">Hubungi Kami</div>
                        <div class="mb-2">
                            <table>
                                <tr>
                                    <td><i class="bi bi-geo-alt"></i></td>
                                    <td width="7rem"></td>
                                    <td>Kota Surakarta, Jawa Tengah</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-envelope"></i></td>
                                    <td></td>
                                    <td><a class="link-light-silent"
                                            href="mailto:digno.christopher@student.uns.ac.id">kontak@klinikpintar.com</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-telephone"></i></td>
                                    <td></td>
                                    <td><a class="link-light-silent" href="tel:0303036040">(0271) 2104-8943</a></td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-headset"></i></td>
                                    <td></td>
                                    <td><a class="link-light-silent" href="/kontak">Beri Kami Pesan</a></td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <a class="btn btn-light btn-sm" href="#!"><i class="bi bi-twitter"></i></a>
                            <a class="btn btn-light btn-sm" href="#!"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-light btn-sm" href="#!"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="fs-4 fw-bold mb-2">Proyek</div>
                        <div><a class="link-light-silent" href="/tentang">Tentang Kami</a></div>
                        <div><a class="link-light-silent" href="#!">Informasi Pengembang</a></div>
                        <div><a class="link-light-silent" href="#!">Repositori GitHub</a></div>
                        <div><a class="link-light-silent" href="/acknowledgements">Acknowledgements</a></div>
                        <div><a class="link-light-silent" target="_blank"
                                href="https://choosealicense.com/licenses/mit/">Lisensi (MIT)</a></div>
                    </div>
                    <div
                        class="col-12 col-md-12 col-lg-4 d-flex flex-column align-items-start align-items-md-center align-items-lg-start">
                        <div class="fs-4 mb-2 fw-bold">Temukan Kami</div>
                        <div>
                            <p class="mb-1">Gedung <strong>KlinikPintar</strong></p>
                            <p class="mb-1">Jl. Ir. Sutami No.109, Jebres, Kec. Jebres, Kota Surakarta, Jawa
                                Tengah 57126</p>
                            <a class="link-light-silent" href="https://g.page/Jurugsolozoo?share">Temukan kami di
                                Google
                                Maps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-footer bg-brand-lightblue">
            <div class="container">
                <div class="row py-1 pb-2">
                    <div class="d-flex justify-content-center">
                        <a class="navbar-brand text-light" href="/">
                            <img src="/assets/brand-logo.svg" alt="" height="50rem">
                            <span class="fs-3">
                                KlinikPintar
                            </span>
                        </a>
                    </div>
                    <div class="text-center text-light">
                        &copy; 2022 <a target="_blank" class="link-light"
                            href="https://s.id/KontakKlinikPintarTeam">KlinikPintar
                            Team</a>, All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Main + Plugin JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="/resources/app.js"></script>
</body>

</html>
