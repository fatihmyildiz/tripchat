<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
     use HasFactory;

    protected $fillable = [
        'room_id',
        'hotel_id',
        'reservation_no',
        'customer_id',
        'checkin_date',
        'checkout_date',
        'adult',
        'children',
        'including',
        'subtotal',
        'status',
    ];

     public function reservationDetail()
    {
        return $this->hasOne(OrderDetail::class, 'reservation_no', 'reservation_no');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
