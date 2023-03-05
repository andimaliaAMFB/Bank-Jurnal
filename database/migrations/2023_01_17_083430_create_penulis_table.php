<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenulisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('penulis')) {
            Schema::create('penulis', function (Blueprint $table) {
                $table->ipAddress('id_penulis',12);
                $table->primary('id_penulis');

                $table->ipAddress('id_akun',12)->nullable();
                $table->ipAddress('id_jurusan',12)->nullable();
                $table->ipAddress('nama_penulis',20);
            });
        }
        Schema::table('penulis', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id')->on('users');

                $table->foreign('id_jurusan')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ->references('id_jurusan')->on('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penuliss');
    }
}
