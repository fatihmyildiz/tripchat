<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class CheckInvoiceOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $userHotelId = auth()->user()->hotel_id;

        $invoiceId = $request->route('reservationId');
        $invoice = Reservation::find($invoiceId);

        if (!$invoice || $invoice->hotel_id !== $userHotelId) {
            abort(404);
        }

        return $next($request);
    }
}
