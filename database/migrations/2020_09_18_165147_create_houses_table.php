<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('house_name');
            $table->integer('area_id');
            $table->integer('user_id');
            $table->string('contact');
            $table->string('pet_policy');
            $table->string('house_type');
            $table->string('parking_lot');
            $table->string('water');
            $table->string('internet_connection');
            $table->string('balcony');
            $table->integer('rent');
            $table->string('description');
            $table->string('featured_image');
            $table->text('images');
            $table->string('status')->default(1);  //1 means available
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
        Schema::dropIfExists('houses');
    }
}
