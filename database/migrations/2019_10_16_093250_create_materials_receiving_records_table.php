<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsReceivingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_receiving_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('material_id');
            $table->integer('user_id');
            $table->integer('amount');
            $table->integer('create_user');
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
        Schema::dropIfExists('materials_receiving_records');
    }
}
