<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('oid')->comment('淘宝订单号');
            $table->text('recipient_information')->comment('收件人信息');
            $table->unsignedInteger('sofa_cover_id');
            $table->unsignedBigInteger('sofa_cover_item_id');
            $table->unsignedBigInteger('user_id');
            $table->text('note')->comment('备注');
            $table->unsignedDecimal('total')->nullable()->comment('订单金额');
            $table->unsignedInteger('count')->nullable()->comment('数量');
            $table->string('dir')->nullable()->comment('载片文件');
            $table->timestamp('exported_at')->nullable()->comment('导出时间');
            $table->timestamp('confirmed_at')->nullable()->comment('确认时间');
            $table->timestamps();
            $table->unique('oid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
