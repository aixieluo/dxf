<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSofaCoverItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofa_cover_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sofa_cover_id');
            $table->string('name')->comment('布料名称');
            $table->string('uid')->comment('材料编号');
            $table->string('color')->comment('颜色');
            $table->string('fid')->comment('规格编号');
            $table->unsignedDecimal('price')->comment('材料单价');
            $table->string('preview')->comment('预览图');
            $table->timestamps();
            $table->unique(['sofa_cover_id', 'name', 'uid'], 'sofa_style');
            $table->unique(['sofa_cover_id', 'color', 'fid', 'price'], 'sofa_format');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofa_cover_items');
    }
}
