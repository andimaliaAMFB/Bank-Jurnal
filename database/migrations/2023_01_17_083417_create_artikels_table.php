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
                $table->ipAddress('id_artikel',12);
                $table->primary('id_artikel');
                
                $table->ipAddress('id_akun',12);
                $table->timestamps();
            });
        }
        Schema::table('artikel', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id')->on('users');
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
