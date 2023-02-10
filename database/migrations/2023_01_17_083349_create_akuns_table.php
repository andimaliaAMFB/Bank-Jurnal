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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->ipAddress('id',12);
                $table->primary('id');
                
                $table->string('username');
                $table->string('password');
                $table->ipAddress('status',12);
                $table->ipAddress('nama_lengkap',20);
                $table->ipAddress('no_telepon',12);
                $table->ipAddress('email',20);
                $table->date('tanggal_lahir');
                $table->ipAddress('id_kota',12);
                $table->ipAddress('id_provinsi',12);
                $table->ipAddress('alamat',200);
                $table->ipAddress('kode_pos',6);
                $table->binary('foto_profil')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('id_kota')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_kota')->on('kota');
                
            $table->foreign('id_provinsi')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_provinsi')->on('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
