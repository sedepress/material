<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsReceivingRecordsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_receiving_records_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('operating_status')->comment('add 增加操作 update 修改操作 delete 删除操作');
            $table->integer('admin_id');
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
        Schema::dropIfExists('materials_receiving_records_logs');
    }
}
