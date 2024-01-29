<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inviter_id')->constrained('users'); // Davet eden kullanıcı
            $table->foreignId('user_id')->constrained('users'); // Davet edilen kullanıcı
            $table->foreignId('hotel_id')->constrained(); // Otel ile ilişkilendirme
            $table->string('token')->unique();
            $table->boolean('accepted')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
