<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_design', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('design_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedInteger('count')->comment('件数');
            $table->text('lengths')->comment('边长集合');
            $table->unsignedInteger('width')->nullable()->comment('耗材宽度');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_design');
    }
}
