<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomPrice;
use App\Models\Availability;

class HotelsController extends Controller
{
    

public function hotellistele()
{
    $hotels = Hotel::all();

    
    $hotels->each(function ($hotel) {
        $lowestPrice = $hotel->rooms()->min('room_price'); 
        $hotel->lowest_room_price = $lowestPrice;
    });

    return response()->json($hotels);
}



public function showhotel($id)
{
    $hotel = Hotel::find($id);

    if (!$hotel) {
        return response()->json(['error' => 'Otel bulunamadı'], 404);
    }

    return response()->json(['hotel' => $hotel], 200);
}


public function getRoomsForHotel($id, Request $request)
{
    $rooms = Room::where('hotel_id', $id)->get();

    $dateRange = $request->input('selected_date_range');

    if (empty($dateRange)) {
        foreach ($rooms as $room) {
            $room->room_price_total = 0;
        } 
        return response()->json($rooms);
    }

    list($startDate, $endDate) = explode(' - ', $dateRange);

    $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
    $endDate = \Carbon\Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');

    $endDate = \Carbon\Carbon::parse($endDate)->subDay()->format('Y-m-d');

    $dayCount = floor((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1;

    foreach ($rooms as $room) {
        $roomFiyatlar = RoomPrice::where('room_id', $room->id)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->get();

        $normalPrice = $room->room_price;

        // Müsaitlik kontrolü
        $availabilityCount = Availability::where('room_id', $room->id)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->count();

        $musaitlik = $availabilityCount > 0 ? 1 : 0;

        if ($roomFiyatlar->isNotEmpty()) {
            $cikilacakgun = $normalPrice * count($roomFiyatlar);
            $ilktoplam = $normalPrice * $dayCount;
            $ikincitoplam = $ilktoplam +  $roomFiyatlar->sum('price');
            $roomTotalPrice = $ikincitoplam - $cikilacakgun;
            
            $room->room_price_total = $roomTotalPrice;
        } else {
            $dayCount = floor((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1;

            $room->room_price_total = $normalPrice * $dayCount;
        }

        $room->musaitlik = $musaitlik;
    }

    return response()->json($rooms);
}





public function api_hotels_search(Request $request)
{
    $search = $request->input('search');
    $checkin_checkout = $request->input('checkin_checkout');
    $adult = $request->input('adult');
    $children = $request->input('children');

    list($checkinDate, $checkoutDate) = explode(' - ', $checkin_checkout);
    $checkinDate = \Carbon\Carbon::createFromFormat('d/m/Y', $checkinDate)->format('Y-m-d');
    $checkoutDate = \Carbon\Carbon::createFromFormat('d/m/Y', $checkoutDate)->format('Y-m-d');
    $dateRange = \Carbon\CarbonPeriod::create($checkinDate, $checkoutDate)
        ->filter(function ($date) use ($checkoutDate) {
            return $date < $checkoutDate;
        })
        ->toArray();

    $hotels = Hotel::where('hotel_name', 'LIKE', '%' . $search . '%')
        ->orWhere('hotel_sehir', 'LIKE', '%' . $search . '%')
        ->orWhere('hotel_ilce', 'LIKE', '%' . $search . '%');

    if ($adult) {
        $hotels->whereHas('rooms', function ($query) use ($adult) {
            $query->where('total_beds', '>', 0);
        });
    }

    if ($children) {
        $hotels->whereHas('rooms', function ($query) use ($children) {
            $query->where('total_single_beds', '>', 0)
                ->orWhere('koltuk', '>', 0);
        });
    }

    $hotels = $hotels->paginate(2); // Set the desired number of items per page

    // Musaitlik Hesaplama
    $availabilityCounts = Availability::whereIn('date', $dateRange)
        ->select('hotel_id', 'date', \DB::raw('COUNT(*) as count'))
        ->groupBy('hotel_id', 'date')
        ->get();
    $hotelAvailabilityCounts = [];

    foreach ($hotels as $hotel) {
        $hotelId = $hotel->id;
        $musaitlik = 0;

        foreach ($dateRange as $messageDate) {
            $availabilityCount = $availabilityCounts
                ->where('hotel_id', $hotelId)
                ->where('date', $messageDate)
                ->first();

            $count = $availabilityCount ? $availabilityCount->count : 0;
            $roomCount = $hotel->rooms()->count();

            if ($count >= $roomCount) {
                $musaitlik = 1;
                break;
            }
        }

        $hotel->musaitlik = $musaitlik;
        $hotelAvailabilityCounts[$hotelId] = $musaitlik;

        // En düşük fiyat hesaplama
        $room = $hotel->rooms()
            ->where('hotel_id', $hotel->id)
            ->orderByRaw('CAST(price AS DECIMAL(10,2))')
            ->first();

        if ($room) {
            $minPrice = $room->room_price;
            $totalPrice = count($dateRange) * $minPrice;
            $hotel->lowest_room_price_total = $totalPrice;
        } else {
            $hotel->lowest_room_price_total = 0;
        }
    }

    return response()->json([
        'hotels' => $hotels->items(),
        'current_page' => $hotels->currentPage(),
        'total_pages' => $hotels->lastPage(),
    ]);
}



public function filtreleme(Request $request)
{
    $search = $request->input('search');
    $checkin_checkout = $request->input('checkin_checkout');
    $adult = $request->input('adult');
    $children = $request->input('children');
    $type = $request->input('type', 0);
    $imkanlar = $request->input('imkanlar', []);
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');

    list($checkinDate, $checkoutDate) = explode(' - ', $checkin_checkout);
    $checkinDate = \Carbon\Carbon::createFromFormat('d/m/Y', $checkinDate)->format('Y-m-d');
    $checkoutDate = \Carbon\Carbon::createFromFormat('d/m/Y', $checkoutDate)->format('Y-m-d');
    $dateRange = \Carbon\CarbonPeriod::create($checkinDate, $checkoutDate)
        ->filter(function ($date) use ($checkoutDate) {
            return $date < $checkoutDate;
        })
        ->toArray();

    $hotels = Hotel::where(function ($query) use ($search) {
        $query->where('hotel_name', 'LIKE', '%' . $search . '%')
            ->orWhere('hotel_sehir', 'LIKE', '%' . $search . '%')
            ->orWhere('hotel_ilce', 'LIKE', '%' . $search . '%');
    });

    // ... (Your existing code for filtering hotels)

    $hotels = $hotels->paginate(3); // Set the desired number of items per page

    // Musaitlik Hesaplama
    $availabilityCounts = Availability::whereIn('date', $dateRange)
        ->select('hotel_id', 'date', \DB::raw('COUNT(*) as count'))
        ->groupBy('hotel_id', 'date')
        ->get();

    foreach ($hotels as $hotel) {
        $hotelId = $hotel->id;
        $musaitlik = 0;

        foreach ($dateRange as $messageDate) {
            $availabilityCount = $availabilityCounts
                ->where('hotel_id', $hotelId)
                ->where('date', $messageDate)
                ->first();

            $count = $availabilityCount ? $availabilityCount->count : 0;
            $roomCount = $hotel->rooms()->count();

            if ($count >= $roomCount) {
                $musaitlik = 1;
                break;
            }
        }

        $hotel->musaitlik = $musaitlik;

        // En düşük fiyat hesaplama
        $room = $hotel->rooms()
            ->orderByRaw('CAST(price AS DECIMAL(10,2))')
            ->first();

        if ($room) {
            $hesapminPrice = $room->room_price;
            $totalPrice = count($dateRange) * $hesapminPrice;
            $hotel->lowest_room_price_total = $totalPrice;
        } else {
            $hotel->lowest_room_price_total = 0;
        }
    }

    // Fiyat filtreleme ve null değerleri filtreleme
    $filteredHotels = $hotels->getCollection()->filter(function ($item) use ($minPrice, $maxPrice) {
        $hotelPrice = (float)$item->lowest_room_price_total;
        return $hotelPrice >= $minPrice && $hotelPrice <= $maxPrice;
    });

    return response()->json([
        'hotels' => $filteredHotels->values()->all(),
        'current_page' => $hotels->currentPage(),
        'total_pages' => $hotels->lastPage(),
    ]);
}



public function getHotelsByRoomAmenitie($roomAmenitieId)
{
    // Sayfa numarasını veya varsayılanı al
    $page = request()->get('page', 1);

    // Her istekte gösterilecek otel sayısı
    $perPage = 2;

    // Başlangıçtan itibaren gösterilecek otel sayısını hesapla
    $offset = ($page - 1) * $perPage;

    // Oda özelliklerine göre ilgili otel ID'lerini al
    $hotelIds = Room::where('amenities', 'LIKE', '%' . $roomAmenitieId . '%')
        ->pluck('hotel_id')
        ->unique()
        ->values();

    // Belirli sayıda oteli al
    $hotels = Hotel::whereIn('id', $hotelIds)
        ->skip($offset)
        ->take($perPage)
        ->get();

    // Eğer "show more" butonuna basıldıysa, daha önce gönderilmiş otelleri de alarak yeni otellerle birleştir
    if ($page > 1) {
        $previousHotels = Hotel::whereIn('id', $hotelIds)
            ->skip(0)
            ->take($perPage * ($page - 1))
            ->get();

        $hotels = $previousHotels->merge($hotels);
    }

    // Otelleri JSON yanıtında gönder
    return response()->json(['hotels' => $hotels]);
}


public function getHotelsByHotelAmenitie($hotelAmenitieId)
{
     $hotels->each(function ($hotel) {
        $lowestPrice = $hotel->rooms()->min('price'); 
        $hotel->lowest_room_price = $lowestPrice;
    });
    // Sayfa numarasını veya varsayılanı al
    $page = request()->get('page', 1);

    // Her istekte gösterilecek otel sayısı
    $perPage = 2;

    // Başlangıçtan itibaren gösterilecek otel sayısını hesapla
    $offset = ($page - 1) * $perPage;

    // Belirli otel özelliklerine göre filtrele ve belirli sayıda oteli al
    $hotels = Hotel::where('hotel_imkanlari', 'LIKE', '%' . $hotelAmenitieId . '%')
                    ->skip($offset)
                    ->take($perPage)
                    ->get();

    // Eğer "show more" butonuna basıldıysa, daha önce gönderilen otelleri de al
    if ($page > 1) {
        $previousHotels = Hotel::where('hotel_imkanlari', 'LIKE', '%' . $hotelAmenitieId . '%')
                              ->skip(0)
                              ->take($perPage * ($page - 1))
                              ->get();

        $hotels = $previousHotels->merge($hotels);
    }

    // Otelleri JSON yanıtında gönder
    return response()->json(['hotels' => $hotels]);
}


}
