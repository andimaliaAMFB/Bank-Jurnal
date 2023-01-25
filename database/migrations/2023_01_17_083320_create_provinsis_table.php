<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('provinsi')) {
            Schema::create('provinsi', function (Blueprint $table) {
                $table->ipAddress('ID_PROVINSI',12);
                $table->primary('ID_PROVINSI');
                $table->ipAddress('NAMA_PROVINSI',20);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinsi');
    }
}
