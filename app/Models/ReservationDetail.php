<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $fillable = [
        'reservation_id',
        'hotel_id',
        'customer_id',
        'reservation_no',
        'transaction_id',
        'payment_method',
        'card_last_digit',
        'paid_amount',
        'booking_date',
        'status',
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'order_no', 'order_no');
    }
}
