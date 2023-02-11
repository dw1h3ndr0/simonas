<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimonasListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simonas_listing', function (Blueprint $table) {
            $table->id();
            $table->string('user_dsbs_id');
            $table->string('kegiatan_id');
            $table->string('pml_id');
            $table->string('pcl_id');
            $table->string('nks');
            $table->string('status')->nullable();
            $table->integer('p1')->nullable();
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
        Schema::dropIfExists('simonas_listing');
    }
}
