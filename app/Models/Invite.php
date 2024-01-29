<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['inviter_id', 'user_id', 'hotel_id', 'token', 'accepted'];

    // Daveti gönderen kullanıcı ilişkisi
    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    // Davet edilen kullanıcı ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Otel ilişkisi
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
