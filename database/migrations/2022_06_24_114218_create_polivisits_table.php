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
        Schema::create('polivisits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_kunjungan");
            $table->unsignedBigInteger("id_penyakit")->nullable();
            $table->boolean("is_closed")->default(false);
            $table->decimal("cost", 10, 0);
            $table->timestamps();

            $table->foreign("id_kunjungan")
                ->references("id")->on("visits")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_penyakit")
                ->references("id")->on("ref_penyakit")
                ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('polivisits');
    }
};
