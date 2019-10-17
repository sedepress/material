<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->unique();
            $table->string('image')->nullable();
            $table->unsignedInteger('receive_count')->default(0)->comment('总的领取数量');
            $table->unsignedInteger('stock')->comment('库存');
            $table->dateTime('recent_deposit_time')->comment('最近存入时间');
            $table->unsignedInteger('create_user')->comment('创建人');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('materials');
    }
}
