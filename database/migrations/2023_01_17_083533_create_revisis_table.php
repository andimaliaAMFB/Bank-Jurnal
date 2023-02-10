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
                $table->ipAddress('id_revisi',12);
                $table->primary('id_revisi');

                $table->ipAddress('id_artikel_detail',12);
                $table->ipAddress('id_akun',12)->nullable();
                $table->ipAddress('status_artikel_baru',12)->nullable();
                $table->boolean('status_revisi')->nullable();
                $table->text('catatan_revisi')->nullable();
                $table->timestamps();
            });
        }
        Schema::table('revisi', function(Blueprint $table) {
            $table->foreign('id_artikel_detail')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('id_artikel_detail')->on('artikel_detail');
                
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
        Schema::dropIfExists('revisis');
    }
}
