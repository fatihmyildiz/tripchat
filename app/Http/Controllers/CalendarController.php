<?php

namespace App\Http\Controllers;
use App\Models\Availability;
use App\Models\Room;
use App\Models\RoomPrice;
use Illuminate\Http\Request;




class CalendarController extends Controller {
    
    /**
     * Display calendar of the resource.
     *
     * @return \Illuminate\View\View
     */
 
public function getAvailability($language, $room_id)
{
    try {
        // Dil kodunu ve room_id'yi kullanarak işlemleri gerçekleştirin

        // Örnek olarak $language değişkenini kullanabilirsiniz
        $title = "Calendar";
        $description = "Your room availability";

        $hotelId = auth()->user()->hotel_id;

        // Odanın verilerini alın
        $room = Room::find($room_id);

        if (!$room) {
            throw new \Exception('Oda bulunamadı. Room ID: ' . $room_id);
        }

        $roomName = $room->room_name;
        $included = $room->included;

        // Odanın uygunluk verilerini alın
        $availabilityData = Availability::where('room_id', $room_id)->get();

        // Takvim verilerini oluşturun
        $events = $availabilityData->map(function ($availability) {
            return [
                'title' => 'Dolu',
                'start' => $availability->date, 
                'backgroundColor' => '#DC4C64',
                'borderColor' => '#DC4C64',
                'allDay' => true,
                'id' => $availability->id,
                'room_id' => $availability->room_id
            ];
        });

        // Diğer odaların listesini alın
        $otherRooms = Room::where('hotel_id', $hotelId)->where('id', '!=', $room_id)->get();

        // View'a değişkenleri gönderin
        return view('pages.applications.calendar.calendar', compact('availabilityData', 'events', 'room_id', 'roomName', 'hotelId', 'title', 'description', 'otherRooms' , 'included'));
    } catch (\Exception $e) {
        // Hata durumunda hatayı yakalayalım ve hatayı dönelim
        return response()->json(['error' => 'Hata: ' . $e->getMessage()], 500);
    }
}




    public function store(Request $request)
{
    // İstekten gelen veriyi alın
    $data = $request->all();

    try {
        // Room modelini kullanarak "room_id" ile odaya ait oteli bulun
        $room = Room::find($data['room_id']);

        if ($room) {
            // Odaya ait otelin "hotel_id" değerini alın
            $hotelId = $room->hotel->id;

            // Veriyi veritabanına ekleyin
            Availability::create([
                'room_id' => $data['room_id'],
                'date' => $data['start'],
                'hotel_id' => $hotelId, // Otelin "hotel_id" değeri
            ]);
        } else {
            // Geçerli bir oda bulunamadığında hata mesajı gönderin
            return response()->json(['error' => 'Geçerli bir oda bulunamadı'], 404);
        }
    } catch (\Exception $e) {
        // Hata mesajını göster
        return response()->json(['error' => $e->getMessage()], 500);
    }

    // Başarı durumunu döndürün
    return response()->json(['message' => 'Event successfully created'], 201);
}
    

    public function destroyEvent(Request $request)
{
    try {
        $data = $request->json()->all();
        $id = $data['id']; // JSON verisinden id'yi alın

        // Etkinliği veritabanından silmek için uygun kodu ekleyin
        Availability::destroy($id);

        return response()->json(['message' => 'Oda Müsait Durumuna Alındı'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hata: ' . $e->getMessage()], 500);
        }
}



public function getRoomPrices($language , $id)
{
    try {
        $title = "Price Calendar";
        $description = "Your room prices";
        $room = Room::find($id);
        
        if (!$room) {
            return response()->json(['error' => 'Oda bulunamadı'], 404);
        }

        $roomPricesData = $room->roomPrices;

        $roomName = $room->room_name;
        $hotelId = $room->hotel_id;
        $included = $room->included;

        $prices = $roomPricesData->map(function ($price) {
            return [
                'date' => $price->date,
                'price' => $price->price,
            ];
        });
        $roomName = $room->room_name;
         $otherRooms = Room::where('hotel_id', $hotelId)->where('id', '!=', $id)->get();

        return view('pages.applications.calendar.pricecalendar', compact('roomPricesData', 'prices', 'id', 'roomName', 'hotelId' , 'title' , 'description','otherRooms','roomName' , 'included'));
    } catch (\Exception $e) {
        return response()->json(['error' => 'Hata: ' . $e->getMessage()], 500);
    }
}

public function addRoomPrice(Request $request)
{
    $data = $request->all();

    try {
        $existingPrice = RoomPrice::where('room_id', $data['room_id'])
            ->where('date', $data['start'])
            ->first();

        if ($existingPrice) {
            //eski fiyatla yer değiştirme
            $existingPrice->delete();
        }

        // Yeni fiyatı ekleme
        RoomPrice::create([
            'room_id' => $data['room_id'],
            'hotel_id' => $data['hotel_id'],
            'date' => $data['start'],
            'price' => $data['title']
        ]);
    } catch (\Exception $e) {
        
        return response()->json(['error' => $e->getMessage()], 500);
    }

    return response()->json(['message' => 'Room Price successfully created'], 201);
}





public function updatePrice(Request $request, $room_id)
    {
        $validatedData = $request->validate([
            'price' => 'required|numeric|between:0,9999.99', 
        ]);

        $room = Room::findOrFail($room_id);
        $room->price = $validatedData['price'];
        $room->save();

        return redirect()->back()->with('success', 'Fiyat güncellendi.');
    }



}