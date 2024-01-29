<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            // hotel_id için referans ekleme
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            // room_id için referans ekleme
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            // hotel_id referansını kaldırma
            $table->dropForeign(['hotel_id']);

            // room_id referansını kaldırma
            $table->dropForeign(['room_id']);
        });
    }
}
