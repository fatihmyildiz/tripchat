<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Room;
use Illuminate\Http\Response;

class AvailabilityController extends Controller
{
   public function getAvailability($id)
{
    try {
        $title = "Calendar";
        $description = "Your room availability";
        $availabilityData = Availability::where('room_id', $id)->get();

        // Odanın adını alın
        $room = Room::find($id);
        $roomName = $room->name;
        $hotelId = $room->hotel_id;


        // Takvim verilerini de view'a gönderiyoruz
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

        // View'a $id ve $roomName değişkenlerini de gönderiyoruz
        return view('pages.applications.calendar.calendar', compact('availabilityData', 'events', 'id', 'roomName', 'hotelId' , 'title' , 'description'));
    } catch (\Exception $e) {
        // Hata durumunda hatayı yakalayalım ve hatayı dönelim
        return response()->json(['error' => 'Hata: ' . $e->getMessage()], 500);
    }
}


public function destroyEvent(Request $request)
{
    try {
        $data = $request->json()->all();
        $id = $data['id']; // JSON verisinden id'yi alın

        // Etkinliği veritabanından silmek için uygun kodu ekleyin
        Availability::destroy($id);

        return response()->json(['message' => 'Etkinlik başarıyla silindi'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hata: ' . $e->getMessage()], 500);
        }
}
}
