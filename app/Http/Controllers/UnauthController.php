<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class UnauthController extends Controller {
    public function index() {
        return response()
            ->view("index")
            ->header("X-Biggest-Thing", "Your-Mom");
    }

    public function about() {
        return view("tentang");
    }

    public function contact(Request $request) {
        // NOTE - Clear test, DO NOT UNCOMMENT
        // RateLimiter::clear("send-message" . $request->ip());
        if (RateLimiter::tooManyAttempts("send-message" . $request->ip(), 1)) {
            $seconds = RateLimiter::availableIn("send-message" . $request->ip());
            $rejectString = "Anda sudah terlalu banyak mengirimkan pesan. Coba kembali dalam " . $seconds . " detik.";
            session()->flash("buttonRateLimited", $rejectString);
        }

        return view("kontak");
    }

    public function acknowledgements() {
        return view("acknowledgements");
    }

    public function submitContactMessage(Request $request) {
        $validator = Validator::make($request->all(), [
            "fullname" => "required|min:3|max:255",
            "email" => "required|email:dns",
            "message" => "required|max:5000"
        ], [
            "required" => "Atribut ini wajib diisi!",
            "email" => "Format alamat email tidak valid!",
            "min" => "Atribut ini harus memuat setidaknya :min karakter!",
            "max" => "Atribut ini maksimal memuat :max karakter!"
        ])->validate();

        $executed = RateLimiter::attempt(
            "send-message" . $request->ip(),
            1,
            function () {
            },
            3600
        );

        if (!$executed) {
            $seconds = RateLimiter::availableIn("send-message" . $request->ip());
            $rejectString = "Anda sudah terlalu banyak mengirimkan pesan. Coba kembali dalam " . $seconds . " detik.";
            return back()->with("messageError", $rejectString)->withInput();
        }

        $message = Message::create($validator);

        return redirect(route("submitContactMessage"))->with("messageSuccess", "nicecock");
    }
}
