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
                $table->ipAddress('id_artikel_detail',12);
                $table->primary('id_artikel_detail');

                $table->ipAddress('id_artikel',12);
                $table->ipAddress('judul_artikel',20);
                $table->ipAddress('status_artikel',12);
                $table->binary('file_artikel');
            });
        }
        Schema::table('artikel_detail', function(Blueprint $table) {
            $table->foreign('id_artikel')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_artikel')->on('artikel');
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
