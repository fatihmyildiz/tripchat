<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomPrice extends Model
{
    protected $table = 'rooms_fiyat'; 
    
    protected $fillable = ['hotel_id','room_id', 'date', 'price']; 
    
    protected $casts = [
        'date' => 'date',
    ];

    
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}