<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasUserDsbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_user_dsbs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('dsbs_id');
            $table->string('kegiatan_id');
            $table->string('status');
            $table->string('leader')->nullable();
            $table->string('kode');
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
        Schema::dropIfExists('simonas_user_dsbs');
    }
}
