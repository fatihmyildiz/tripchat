<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomsFiyatForeignKey extends Migration
{
    public function up()
    {
        Schema::table('rooms_fiyat', function (Blueprint $table) {
            // Eğer varsa, mevcut dış anahtar kısıtlamasını kaldır
            $table->dropForeign(['room_id']);

            // Yeni dış anahtar kısıtlamasını tanımla
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade'); // Bu satır, dış anahtar kısıtlamasını ayarlar
        });
    }

    public function down()
    {
        // Geri alma işlemi gerekli miyse burada tanımlanabilir
    }
}