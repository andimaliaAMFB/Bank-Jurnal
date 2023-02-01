<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('akun')) {
            Schema::create('akun', function(Blueprint $table) {
                $table->ipAddress('ID_AKUN',12);
                $table->primary('ID_AKUN');

                $table->ipAddress('USERNAME',20);
                $table->ipAddress('PASSWORD',12);
                $table->ipAddress('NAMA',20);
                $table->ipAddress('STATUS_PENGGUNA',12);
                $table->ipAddress('NO_TELEPON',12);
                $table->ipAddress('EMAIL',20);
                $table->date('TANGGAL_LAHIR');
                $table->ipAddress('ID_KOTA',12);
                $table->ipAddress('ID_PROVINSI',12);
                $table->ipAddress('ALAMAT',200);
                $table->ipAddress('KODE_POS',6);
                $table->binary('FOTO_PROFIL')->nullable();
            });
        }
        Schema::table('akun', function(Blueprint $table) {
            $table->foreign('ID_KOTA')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_KOTA')->on('kota');
                
            $table->foreign('ID_PROVINSI')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_PROVINSI')->on('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akun');
    }
}
