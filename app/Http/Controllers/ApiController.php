<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller {
    public function ajaxEditProfile(Request $request) {
        $token = $request->all()["token"];
        $key = env("DEF_JWT_SECRET");
        $algo = "HS256";
        $decoded = "";
        $attributeProperties = [
            "account" => ["fullname", "username", "email", "password"],
            "patient" => [],
            "doctor" => [],
        ];
        $rules = [
            "fullname" => ["max:255", "min:3"],
            "username" => ["max:255", "min:3", "unique:users", "alpha_dash"],
            "email" => ["email:dns", "unique:users"],
            "password" => ["max:32", "min:8"],
        ];
        $messageLocale = [
            "required" => "Atribut ini wajib diisi!",
            "alpha_dash" => "Atribut hanya boleh berisi karakter alfanumerik, dash (-), dan underscore (_)",
            "email" => "Format alamat email tidak valid!",
            "min" => "Atribut ini harus memuat setidaknya :min karakter!",
            "max" => "Atribut ini maksimal memuat :max karakter!",
            "unique" => "Atribut ini sudah digunakan!"
        ];

        // SECTION Verifying Credentials
        try {
            $decoded = JWT::decode($token, new Key($key, $algo));
        } catch (ExpiredException $e) {
            return $this->returnWithError("tokenExpired", "Token anda kadaluwarsa. Silakan refresh/segarkan halaman ini.");
        } catch (\Throwable $th) {
            return $this->returnWithError("tokenBasicException", $th->getMessage());
        }

        if ($decoded->iss != "KlinikPintar") {
            return $this->returnWithError("tokenIssuerMismatch", "Kesalahan token. Hubungi mantainer (Kode: is-mm).", 500);
        }

        if (!isset($request->all()["attribute"])) {
            return $this->returnWithError("attributeEmpty", "Atribut ini tidak boleh kosong", 422);
        }
        if (!isset($request->all()["password"])) {
            return $this->returnWithError("passwordEmpty", "Password tidak boleh kosong", 422);
        }
        if (!isset($request->all()["attributeGroup"]) || !isset($request->all()["attributeType"])) {
            return $this->returnWithError("attributeIncomplete", "Kesalahan atribut. Hubungi mantainer (Kode: atr-inc)", 500);
        }
        if (!$this->syncAttributeProperties($request->all()["attributeGroup"], $request->all()["attributeType"], $attributeProperties)) {
            return $this->returnWithError("attributePropertiesMismatch", "Kesalahan atribut. Hubungi mantainer (Kode: atr-mm)", 500);
        }

        $user = User::where("username", "=", $decoded->username)->first();

        if ($user == null) {
            return $this->returnWithError("usernameSemanticError", "Kesalahan atribut. Hubungi mantainer (Kode: usn-err)", 500);
        }

        if (!Hash::check($request->all()["password"], $user->password)) {
            return $this->returnWithError("wrongPassword", "Password yang dimasukkan tidak sesuai.", 403);
        }
        // !SECTION Verifying Credentials

        // SECTION Validating attributes and Applying changes
        $changedAttribute = $request->all()["attributeType"];
        $newValue = $request->all()["attribute"];

        $validator = Validator::make(
            [$changedAttribute => $newValue],
            $rules,
            $messageLocale
        );
        if ($validator->fails()) {
            return $this->returnWithError("attributeMisverification", $validator->getMessageBag()->get($changedAttribute), 422);
        } else {
            if ($changedAttribute == "password") {
                $newValue = Hash::make($newValue);
            }
            $user->$changedAttribute = $newValue;
            $user->save();

            return [
                "success" => true
            ];
        }
        // !SECTION Validating attributes and Applying changes

    }

    private function returnWithError($errcode, $message, $code = 403) {
        return response()->json([
            "success" => false,
            "errcode" => $errcode,
            "message" => $message,
        ], $code);
    }

    private function inArray($lhs, $array) {
        foreach ($array as $item) {
            if ($lhs == $item) {
                return true;
            }
        }
        return false;
    }

    private function syncAttributeProperties($attributeGroup, $attributeType, $attributeProperties) {
        foreach ($attributeProperties as $group => $type) {
            if ($attributeGroup == $group) {
                foreach ($attributeProperties[$group] as $type) {
                    if ($attributeType == $type) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
