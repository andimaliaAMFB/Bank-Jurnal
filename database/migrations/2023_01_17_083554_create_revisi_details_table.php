<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('revisi_detail')) {
            Schema::create('revisi_detail', function (Blueprint $table) {
                $table->ipAddress('ID_DETAILREVISI',12);
                $table->primary('ID_DETAILREVISI');
                
                $table->ipAddress('ID_REVISI',12);
                $table->date('TANGGAL_REVISI');
                $table->ipAddress('STATUS_ARTIKEL_BARU',12);
                $table->boolean('STATUS_REVISI');
                $table->text('REVISI');
            });
        }
        Schema::table('revisi_detail', function(Blueprint $table) {
            $table->foreign('ID_REVISI')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->references('ID_REVISI')->on('revisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisi_details');
    }
}
