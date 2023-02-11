<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasDsbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_dsbs', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan_id');
            $table->string('provinsi_id');
            $table->string('kabupaten_id');
            $table->string('kecamatan_id');
            $table->string('desa_id');
            $table->string('nks');
            $table->string('nbs');
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
        Schema::dropIfExists('simonas_dsbs');
    }
}
