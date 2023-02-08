<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('artikel_detail')) {
            Schema::create('artikel_detail', function (Blueprint $table) {
                $table->ipAddress('ID_DETAILARTIKEL',12);
                $table->primary('ID_DETAILARTIKEL');

                $table->ipAddress('ID_ARTIKEL',12);
                $table->ipAddress('JUDUL_ARTIKEL',20);
                $table->date('TANGGAL_UPLOAD');
                $table->ipAddress('STATUS_ARTIKEL',12);
                $table->binary('ARTIKEL');
            });
        }
        Schema::table('artikel_detail', function(Blueprint $table) {
            $table->foreign('ID_ARTIKEL')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_ARTIKEL')->on('artikel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artikel_detail');
    }
}
