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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pasien");
            $table->unsignedBigInteger("id_reservasi");
            $table->integer("bp_sistole");
            $table->integer("bp_diastole");
            $table->integer("heart_rate");
            $table->timestamp("waktu_kunjungan");
            $table->integer("age_years");
            $table->integer("age_months");
            $table->integer("age_days");
            $table->timestamps();

            $table->foreign("id_pasien")
                ->references("id")->on("patients")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_reservasi")
                ->references("id")->on("reservations")
                ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('visits');
    }
};
