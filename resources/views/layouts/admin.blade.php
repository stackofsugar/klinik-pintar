<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard ∙ KlinikPintar</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/resources/admin.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin/dashboard">
            <img src="/assets/brand-logo.svg" alt="" height="28px" class="me-1">
            Admin Dash
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @yield('home-active')" href="/admin/dashboard">
                                <i class="bi bi-house-door me-1"></i>
                                Dashboard Admin
                            </a>
                        </li>
                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
                        <span>Manajemen Akun</span>
                    </h6>
                    <ul class="nav flex-column">
                        @cannot('admin.cashier')
                            <li class="nav-item">
                                <a class="nav-link @yield('useracc-active')" href="/admin/dashboard/account/user">
                                    <i class="bi bi-person me-1"></i>
                                    Akun Pengguna
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-heart-pulse me-1"></i>
                                    Dokter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-bandaid me-1"></i>
                                    Pasien
                                </a>
                            </li>
                        @endcannot
                        @can('admin.god')
                            <a class="nav-link" href="#">
                                <i class="bi bi-emoji-smile me-1"></i>
                                Administrator
                            </a>
                        @endcan
                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
                        <span>Manajemen Operasi</span>
                    </h6>
                    @can('admin.godglobal')
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link @yield('kunjungan-active')" href="{{ route('kunjungan') }}">
                                    <i class="bi bi-pin-map me-1"></i>
                                    Kunjungan
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @can('admin.godpoli')
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link @yield('kunjunganpoli-active')" href="{{ route('kunjunganpoli') }}">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Kunjungan Poli
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @can('admin.godcashier')
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link @yield('tagihan-active')" href="{{ route('adminTagihan') }}">
                                    <i class="bi bi-cash me-1"></i>
                                    Tagihan
                                </a>
                            </li>
                        </ul>
                    @endcan


                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
                        <span>Keluar</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class=" bi bi-box-arrow-left me-1"></i>
                                Menu Utama
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/logout">
                                <i class="bi bi-box-arrow-left me-1"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
                @yield('content')
            </main>

            {{-- Main + Plugin JS --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
            <script src="/resources/app.js"></script>
</body>

</html>
