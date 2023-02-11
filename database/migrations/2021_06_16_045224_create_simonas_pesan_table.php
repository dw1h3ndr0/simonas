<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasPesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_pesan', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('judul');
            $table->string('pesan');
            $table->string('penerima');
            $table->stripcslashes('no_penerima');
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
        Schema::dropIfExists('simonas_pesan');
    }
}
