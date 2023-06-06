<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_karyawans', function (Blueprint $table) {
            $table->id();


            $table->foreignId('karyawan_id')->nullable()->constrained('users')->nullOnDelete()->nullable();

            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');


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
        Schema::dropIfExists('status_karyawans');
    }
}
