<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
     use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_name',
        'hotel_id',
        'room_price',
        'included',
        'adults',
        'total_rooms',
        'room_amenities',
        'room_size',
        'double_bed',
        'single_bed',
        'king_size_bed',
        'sofa',
        'bathroom',
        'balcony',
        'room_photos',
        
    ];
    public function roomPhotos()
    {
        return $this->hasMany(RoomPhoto::class, 'room_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'room_id');
    }

    public function events()
    {
        return $this->hasMany(EventDate::class, 'room_id');
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class, 'room_id');
    }
}
