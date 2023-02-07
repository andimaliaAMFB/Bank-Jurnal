<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('revisi')) {
            Schema::create('revisi', function (Blueprint $table) {
                $table->ipAddress('ID_REVISI',12);
                $table->primary('ID_REVISI');

                $table->ipAddress('ID_DETAILARTIKEL',12);
                $table->ipAddress('ID_AKUN',12)->nullable();
            });
        }
        Schema::table('revisi', function(Blueprint $table) {
            $table->foreign('ID_DETAILARTIKEL')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_DETAILARTIKEL')->on('artikel_detail');
            $table->foreign('ID_AKUN')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_AKUN')->on('akun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisis');
    }
}
