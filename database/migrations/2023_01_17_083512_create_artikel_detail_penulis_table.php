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
                $table->ipAddress('id_list_penulis',12);
                $table->primary('id_list_penulis');

                $table->ipAddress('id_penulis',12);
                $table->ipAddress('id_artikel_detail',12);
            });
        }
        Schema::table('artikel_detail_penulis', function(Blueprint $table) {
            $table->foreign('id_penulis')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_penulis')->on('penulis');
                
            $table->foreign('id_artikel_detail')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_artikel_detail')->on('artikel_detail');
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
