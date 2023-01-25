<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('artikel')) {
            Schema::create('artikel', function (Blueprint $table) {
                $table->ipAddress('ID_ARTIKEL',12);
                $table->primary('ID_ARTIKEL');
                
                $table->ipAddress('ID_AKUN',12);
            });
        }
        Schema::table('artikel', function(Blueprint $table) {
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
        Schema::dropIfExists('artikel');
    }
}
