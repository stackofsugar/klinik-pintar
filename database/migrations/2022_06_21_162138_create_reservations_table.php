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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pasien");
            $table->unsignedBigInteger("id_dokter");
            $table->unsignedBigInteger("id_poli_bagian");
            $table->dateTime("planned_arrival");
            $table->string("phone_num", 13);
            $table->string("reservation_code", 16)->collation("utf8mb4_bin");
            $table->enum("status_pasien", ["terjadwal", "kadaluwarsa"]);
            $table->timestamps();

            $table->foreign("id_pasien")
                ->references("id")->on("patients")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_dokter")
                ->references("id")->on("doctors")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_poli_bagian")
                ->references("id")->on("ref_poli_bagian")
                ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reservations');
    }
};
