<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_mobils', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategori_mobil_id')->constrained('kategori_mobils')->onDelete('cascade');

            $table->string('nama_produk');
            $table->decimal('harga_produk', 12, 2);
            $table->text('deskripsi_produk');

            $table->string('slug_produk');

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
        Schema::dropIfExists('produk_mobils');
    }
}
