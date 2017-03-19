<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropsDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crops_districts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('crop_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->timestamps();

            $table->foreign('crop_id')
                  ->references('id')
                  ->on('crops')
                  ->onDelete('cascade');

            $table->foreign('district_id')
                  ->references('id')
                  ->on('districts')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crops_districts');
    }
}
