<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("nik", 16);
            $table->string("no_rm", 16);
            $table->string("place_of_birth");
            $table->date("date_of_birth");
            $table->string("address");
            $table->string("rt");
            $table->string("rw");
            $table->unsignedBigInteger("kota_id");
            $table->unsignedBigInteger("provinsi_id");
            $table->timestamps();

            $table->foreign("kota_id")
                ->references("id")->on("ref_kota")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("provinsi_id")
                ->references("id")->on("ref_provinsi")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("user_id")
                ->references("id")->on("users")
                ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('patients');
    }
};
