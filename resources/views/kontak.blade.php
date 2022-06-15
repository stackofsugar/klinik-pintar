@extends('layouts.main')

@section('title', 'Kontak')
@section('kontak-active', 'active')

@section('content')
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center mb-1"><strong>Kontak</strong> Kami</h1>
            <p class="text-center text-muted">Beri kami pesan menggunakan <strong>form di bawah ini</strong>.</p>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
                @if (session('messageError'))
                    <div class="mb-4 alert alert-danger" role="alert">
                        <p class="mb-0"><strong>Pesan tidak terkirim</strong></p>
                        <p class="mb-0">{{ session('messageError') }}</p>
                    </div>
                @endif
                @if (session('messageSuccess'))
                    <div class="mb-4 alert alert-success" role="alert">
                        <p class="mb-0">Pesan anda sudah terkirim!</p>
                    </div>
                @endif
                <form class="row" action="{{ route('submitContactMessage') }}" method="post">
                    @csrf
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label for="fullname" class="form-label">Nama Lengkap</span></label>
                    <input @auth value="{{ Auth::user()->fullname }}" readonly @else value="{{ old('fullname') }}"
                        @endauth type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                        name="fullname" required autofocus>
                    @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                <input @auth value="{{ Auth::user()->email }}" readonly @else value="{{ old('email') }}"
                    @endauth type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @if ($errors->isEmpty())
                    <div id="emailHelp" class="form-text">Supaya kami dapat membalas pesan anda</div>
                @endif
            </div>
            <div class="col-12 mb-2">
                <label for="message" class="form-label">Pesan Anda</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="messageTextArea"
                    oninput="updateWordCount(this)" name=" message" rows="5" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-1">
                <p class="text-muted mb-1" id="word-counter"><span id="words-now">0</span>
                    / 5000 karakter</p>
                <p class=" text-danger">Anda hanya dapat mengirim <strong>1 pesan</strong> dalam <strong>1
                        jam</strong>.</p>
            </div>
            <div class="d-flex">
                <div
                    @if (session('buttonRateLimited')) data-bs-toggle="tooltip" data-bs-placement="right" title="{{ session('buttonRateLimited') }}" @endif>
                    <button type="submit" class="btn btn-primary me-2"
                        @if (session('buttonRateLimited')) disabled @endif>Kirim
                        Pesan
                    </button>
                </div>
                <a data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" href="#!"
                    class="btn btn-warning">Hapus Pesan</a>
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Konfirmasi hapus pesan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin ingin menghapus pesan anda?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    id="dismissModal">Tidak</button>
                                <button type="button" class="btn btn-primary" onclick="deleteMessage()">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    function deleteMessage() {
        $("#messageTextArea").val("");
        $("#dismissModal").trigger("click");
    }

    function updateWordCount(that) {
        var cur_length = $(that).val().length;
        $("#words-now").html(cur_length);
        if (cur_length > 5000) {
            $("#word-counter").removeClass("text-muted");
            $("#word-counter").addClass("text-danger fw-bold");
        } else {
            $("#word-counter").addClass("text-muted");
            $("#word-counter").removeClass("text-danger fw-bold");
        }
    }
</script>
@endsection
