<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderIntoSofaCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sofa_covers', function (Blueprint $table) {
            $table->unsignedBigInteger('order')->default(0)->comment('序列');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sofa_covers', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
