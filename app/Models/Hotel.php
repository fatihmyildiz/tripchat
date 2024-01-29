<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

     protected $fillable = [
        'hotel_name',
        'hotel_type',
        'hotel_description',
        'hotel_sehir',
        'hotel_ilce',
        'hotel_konum',
        'hotel_degerlendirme',
        'hotel_photo',
        'galleryImgs',
    ];

    public function hotelPhotos()
    {
        return $this->belongsToMany(HotelPhoto::class);
    }


    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

     public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
    
    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'hotel_id');
    }
}
