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
        Schema::create('tindakan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_polivisit");
            $table->unsignedBigInteger("id_tindakan");
            $table->decimal("harga", 10, 0);
            $table->integer("jumlah");
            $table->timestamps();

            $table->foreign("id_polivisit")
                ->references("id")->on("polivisits")
                ->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id_tindakan")
                ->references("id")->on("ref_tindakan")
                ->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tindakan');
    }
};
