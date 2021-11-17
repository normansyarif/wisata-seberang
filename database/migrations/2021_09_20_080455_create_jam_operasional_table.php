<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamOperasionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam_operasional', function (Blueprint $table) {
            $table->id();
            $table->integer('id_konten');
            $table->enum('hari', ['senin', 'selesa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->time('mulai');
            $table->time('berakhir');
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
        Schema::dropIfExists('jam_operasional');
    }
}
