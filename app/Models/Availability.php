<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_id',
        'date',
    ];

     protected $casts = [
        'date' => 'date',
    ];
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

     public static function getRoomCountByHotelAndDateRange($hotelId, $startDate, $endDate)
    {
        // Tarih formatını 'Y-m-d' olarak düzenle
        $formattedStartDate = date('Y-m-d', strtotime($startDate));
        $formattedEndDate = date('Y-m-d', strtotime($endDate));

        return DB::table('availabilities')
            ->where('hotel_id', $hotelId)
            ->whereBetween('date', [$formattedStartDate, $formattedEndDate])
            ->count();
    }

}
