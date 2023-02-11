<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasSupervisorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_supervisor', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kegiatan_id');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('email');
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
        Schema::dropIfExists('simonas_supervisor');
    }
}
