<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCucisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_cucis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kategori_mobil_id')->constrained('kategori_mobils')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('produk_id')->constrained('produk_mobils')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('karyawan_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->bigInteger('karyawan_id')->nullable();

            $table->string('nama_pemesan');
            $table->string('no_telp_pemesan');
            $table->string('nama_mobil');
            $table->string('no_plat_mobil');
            $table->string('tanggal_pesan');
            $table->string('jam_pesan');
            $table->string('status_pesan')->nullable();
            $table->string('status_bayar')->nullable();


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
        Schema::dropIfExists('booking_cucis');
    }
}
