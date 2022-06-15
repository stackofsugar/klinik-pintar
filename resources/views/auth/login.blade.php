@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">Masuk <strong>KlinikPintar</strong></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6">
                @if (session('loginError'))
                    <div class="alert alert-danger mb-2" role="alert">
                        <div><strong>Login Gagal</strong></div>
                        <div>{{ session('loginError') }}</div>
                    </div>
                @endif
                <div>
                    <form action="{{ route('login') }}" method="POST" class="row">
                        @csrf
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}" required autofocus>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    <span id="passwordPeek" class="input-group-text"
                                        onmousedown="mousedownPasswordPeek(this)" onmouseup="mouseupPasswordPeek(this)">
                                        <i class="bi bi-eye-fill"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label for="remember">Ingat Saya</label>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-100">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-3">
                    <p>Belum memiliki akun? Silakan <a href="{{ route('register') }}">daftar</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
