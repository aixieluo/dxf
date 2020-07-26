<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('设计图名称');
            $table->string('img')->comment('预览图');
            $table->text('types')->comment('边长类型集合');
            $table->string('model')->comment('实例模型');
            $table->string('accessories')->nullable()->comment('辅料名称');
            $table->unsignedInteger('accessories_count')->nullable()->comment('辅料个数');
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
        Schema::dropIfExists('designs');
    }
}
