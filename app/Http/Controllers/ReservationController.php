<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
{
    $title = "Otel Rezervasyonları";
    $description = "Tüm Rezervasyonlarınız Burada Listelenir";
    $hotelId = Auth::user()->hotel_id;

    $status = $request->input('status', null); // status parametresi yoksa varsayılan değeri null olarak ayarlanır

    // Query Builder'ı kullanarak rezervasyonları çekiyoruz
    $query = Reservation::where('hotel_id', $hotelId)->orderBy('created_at', 'desc');

    // Eğer status parametresi varsa, ona göre filtreleme yapıyoruz
    if ($status !== null) {
        // Filtreleme
        switch ($status) {
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
                $query->where('status', $status);
                break;
            default:
                // Geçersiz status değeri, hepsini göster
                break;
        }
    }

    // paginate() fonksiyonunu kullanarak sayfa başına kaç kayıt gösterileceğini belirtiyoruz
    $Reservations = $query->paginate(20); // Örneğin, her sayfada 10 rezervasyon gösteriyoruz

    return view('pages.applications.ecommerce.reservations', compact('Reservations', 'title', 'description', 'status'));
}

public function reservationsearch(Request $request)
{
    $title = "Otel Rezervasyonları";
    $description = "Tüm Rezervasyonlarınız Burada Listelenir";
    $hotelId = Auth::user()->hotel_id;

    $status = $request->input('status', null); // status parametresi yoksa varsayılan değeri null olarak ayarlanır
    $search = $request->input('search', null); // search parametresi yoksa varsayılan değeri null olarak ayarlanır

    // Query Builder'ı kullanarak rezervasyonları çekiyoruz
    $query = Reservation::with('customer') // Eager loading ile customer ilişkisini yüklüyoruz
        ->where('hotel_id', $hotelId)
        ->orderBy('created_at', 'desc');

    // Eğer status parametresi varsa, ona göre filtreleme yapıyoruz
    if ($status !== null) {
        // Filtreleme
        switch ($status) {
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
                $query->where('status', $status);
                break;
            default:
                // Geçersiz status değeri, hepsini göster
                break;
        }
    }

    // Eğer search parametresi varsa, müşteri adına veya rezervasyon numarasına göre filtreleme yapıyoruz
    if ($search !== null) {
        $query->where(function ($query) use ($search) {
            $query->whereHas('customer', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhere('reservation_no', 'LIKE', '%' . $search . '%');
        });
    }

    $Reservations = $query->paginate(20);
    return view('pages.applications.ecommerce.reservations_search', compact('Reservations', 'title', 'description', 'status', 'search'));
}





public function ReservationInvoice($language , $reservationId)
{
    $title = "Otel Rezervasyonları";
    $description = "Tüm Rezervasyonlarınız Burada Listelenir";
    $reservationDetails = Reservation::where('id', $reservationId)->first();

    return view('pages.applications.ecommerce.invoice', compact('reservationDetails', 'title', 'description'));
}

public function updateStatus(Request $request, $language, $reservationId)
{
      $newStatus = $request->input('status');

        // İlgili rezervasyonu bul
        $reservation = Reservation::findOrFail($reservationId);

        // Status değerini güncelle
        $reservation->status = $newStatus;
        $reservation->save();

    return redirect()->route('reservation.reservations', ['language' => $language]);
}

}
