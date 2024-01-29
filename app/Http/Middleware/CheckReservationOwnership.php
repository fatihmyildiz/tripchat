<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CheckReservationOwnership
{
    public function handle($request, Closure $next)
    {
        // İptal edilmek istenen rezervasyonu bul
        $reservationId = $request->route('reservationId');
        $reservation = Reservation::find($reservationId);

        // Rezervasyonu bulamazsak hata sayfasına yönlendir
        if (!$reservation) {
            abort(404);
        }

        if (Auth::user()->hotel_id !== $reservation->hotel_id) {
            abort(403, 'Bu rezervasyonu iptal etme yetkiniz bulunmuyor.');
        }

        

        return $next($request);
    }
}
