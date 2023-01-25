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
                $table->ipAddress('ID_PENULIS',12);
                $table->primary('ID_PENULIS');

                $table->ipAddress('ID_AKUN',12);
                $table->ipAddress('ID_JURUSAN',12);
                $table->ipAddress('NAMA_PENULIS',20);
            });
        }
        Schema::table('penulis', function(Blueprint $table) {
            $table->foreign('ID_AKUN')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_AKUN')->on('akun');

                $table->foreign('ID_JURUSAN')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ->references('ID_JURUSAN')->on('jurusan');
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
