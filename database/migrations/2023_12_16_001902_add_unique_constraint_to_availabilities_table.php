<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            // Benzersiz bileşik anahtar
            $table->unique(['hotel_id', 'room_id', 'date']);
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
            // Bileşik anahtarı geri almak istiyorsanız, burada tanımlayabilirsiniz.
            // Örnek: $table->dropUnique(['hotel_id', 'room_id', 'date']);
        });
    }
}
