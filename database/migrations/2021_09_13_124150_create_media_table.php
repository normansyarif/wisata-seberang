<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->integer('id_media')->primary();
            $table->string('judul_media');
            $table->mediumText('deskripsi');
            $table->string('author');
            $table->integer('tahun');
            $table->tinyInteger('status');
            $table->integer('id_uploader');
            $table->integer('id_koleksi');
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
        Schema::dropIfExists('media');
    }
}
