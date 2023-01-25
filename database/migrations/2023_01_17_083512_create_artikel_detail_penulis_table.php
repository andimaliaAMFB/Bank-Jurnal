<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelDetailPenulisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('artikel_detail_penulis')) {
            Schema::create('artikel_detail_penulis', function (Blueprint $table) {
                $table->ipAddress('ID_LIST_PENULIS',12);
                $table->primary('ID_LIST_PENULIS');

                $table->ipAddress('ID_PENULIS',12);
                $table->ipAddress('ID_DETAILARTIKEL',12);
            });
        }
        Schema::table('artikel_detail_penulis', function(Blueprint $table) {
            $table->foreign('ID_PENULIS')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_PENULIS')->on('penulis');
            $table->foreign('ID_DETAILARTIKEL')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_DETAILARTIKEL')->on('artikel_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikel_detail_penuliss');
    }
}
