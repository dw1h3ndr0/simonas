<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi_id',2);
            $table->string('kabupaten_id',2);
            $table->string('kode',3);
            $table->string('kecamatan',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simonas_kecamatan');
    }
}
