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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("poli_bagian_id");
            $table->string("sip_num", 20);
            $table->string("phone_num", 13);
            $table->boolean("is_active")->default(false);

            $table->foreign("user_id")
                ->references("id")->on("users")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("poli_bagian_id")
                ->references("id")->on("ref_poli_bagian")
                ->onUpdate("cascade")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('doctors');
    }
};
