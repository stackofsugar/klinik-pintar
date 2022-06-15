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
        Schema::create('ref_kota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("provinsi_id");
            $table->boolean("is_city");
            $table->string("name");

            $table->foreign("provinsi_id")
                ->references("id")->on("ref_provinsi")
                ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ref_kota');
    }
};
