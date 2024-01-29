<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomPhoto;
use App\Models\Availability;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view('admin.room_view', compact('rooms'));
    }

    public function getRoomDetails($language , $room_id)
    {
        $title = "Room Details";
        $description = "Update your room settings";
        $roomDetails = Room::find($room_id);

        if (!$roomDetails) {
            abort(404, 'Oda bulunamadı');
        }

        return view('pages.applications.ecommerce.product_detail', compact('roomDetails' , 'title' , 'description'));
    }

public function createRoom(Request $request, $language)
{
    $title = "Room Details";
    $description = "Update your room settings";
    $hotelId = auth()->user()->hotel_id;

    // Form verilerini al
    $room_name = $request->input('room_name');
    $room_price = $request->input('room_price');
    $included = $request->input('included');
    $adults = $request->input('adults');
    $room_size = $request->input('room_size');    
    $double_bed = $request->input('double_bed');
    $single_bed = $request->input('single_bed');
    $king_size_bed = $request->input('king_size_bed');
    $sofa = $request->input('sofa');
    $bathroom = $request->input('bathroom');
    $balcony = $request->input('balcony');
    $room_amenities = $request->input('amenities', []);

    // Veritabanına ekle
    $room = new Room();    
    $room->room_name = $room_name;
    $room->hotel_id = $hotelId; 
    $room->room_price = $room_price;
    $room->included = $included;
    $room->adults = $adults;
    $room->room_size = $room_size;   
    $room->double_bed = $double_bed;
    $room->single_bed = $single_bed;
    $room->king_size_bed = $king_size_bed;
    $room->sofa = $sofa;
    $room->bathroom = $bathroom;
    $room->balcony = $balcony;
    $room->room_amenities = implode(',', $room_amenities);

    $room->save(); // Odayı kaydet

    // Odaya özgü klasörü oluştur
    $roomFolder = '/' . $room->id;
    Storage::disk('rooms')->makeDirectory($roomFolder);

    // Görselleri taşı ve veritabanına dosya yolunu kaydet
    foreach ($request->file('room_images') as $image) {
        $imagePath = $image->store($roomFolder, 'rooms');

        // Veritabanına dosya yolunu kaydet
        RoomPhoto::create([
            'room_id' => $room->id,
            'image_path' => $imagePath,
        ]);
    }

    return redirect()->route('hotel.product_list', ['language' => $language]);
}



   public function updateRoomDetails(Request $request, $language, $room_id)
{
    $room = Room::find($room_id);
    $title = "Room Details";
    $description = "Update your room settings";

    if (!$room) {
        abort(404, 'Oda bulunamadı');
    }

    // Formdan gelen 'sofa' değerini al
    $sofaValue = $request->input('sofa');
    $bathroomValue = $request->input('bathroom');
    $balconyValue = $request->input('balcony');
    $includedValue = $request->input('included');

    // Diğer formdan gelen değerleri al
    $room_amenities = $request->input('room_amenities', []);
    $amenitiesString = implode(',', $room_amenities);

    // Diğer alanları güncelle
    $updateResult = $room->update([
        'room_amenities' => $amenitiesString,
        'room_name' => $request->input('room_name'),
        'room_price' => $request->input('room_price'),
        'included' => $includedValue,
        'adults' => $request->input('adults'),
        'room_size' => $request->input('room_size'),
        'double_bed' => $request->input('double_bed'),
        'single_bed' => $request->input('single_bed'),
        'king_size_bed' => $request->input('king_size_bed'),
        'sofa' => $sofaValue,
        'bathroom' => $bathroomValue,
        'balcony' => $balconyValue,
    ]);

     $photoFolder = public_path("assets/img/rooms/{$room_id}");

// Eğer yeni fotoğraf varsa işlemi gerçekleştir
if ($request->hasFile('room_images')) {
    if (file_exists($photoFolder)) {
        $files = glob("{$photoFolder}/*");

        foreach ($files as $file) {
            unlink($file);
        }
    }

    $oldPhotos = RoomPhoto::where('room_id', $room_id)->get();

    // Her bir eski fotoğrafı sırasıyla sil
    foreach ($oldPhotos as $photo) {
        $photo->delete();
    }

    $roomFolder = '/' . $room->id;
    Storage::disk('rooms')->makeDirectory($roomFolder);

    // Görselleri taşı ve veritabanına dosya yolunu kaydet
    foreach ($request->file('room_images') as $image) {
        $imagePath = $image->store($roomFolder, 'rooms');

        // Veritabanına dosya yolunu kaydet
        RoomPhoto::create([
            'room_id' => $room->id,
            'image_path' => $imagePath,
        ]);
    }
}


    $roomDetails = Room::find($room_id);

    // Güncellendikten sonra view'e yönlendir
    return view('pages.applications.ecommerce.product_detail', compact('roomDetails', 'language', 'title', 'description'));
}

public function deleteRoom(Request $request, $language, $room_id)
    {
        // Oda silme işlemleri
        $room = Room::find($room_id);

        if (!$room) {
            abort(404, 'Oda bulunamadı');
        }

        $room->delete();
        
        return redirect()->route('hotel.product_list', ['language' => $language])->with('success', 'Oda başarıyla silindi.');
    }


public function closeRoomToday(Request $request, $id)
{
    $room = Room::find($id);
    if ($room) {
        $room->update(['status' => 'closed']);

        $date = $request->input('date');

        Availability::create([
            'hotel_id' => $room->hotel_id, 
            'room_id' => $id,
            'date' => $date,
        ]);

        return response()->json(['message' => 'Oda başarıyla kapatıldı ve Availability tablosuna kayıt eklendi.']);
    }

    return response()->json(['message' => 'Oda bulunamadı.'], 404);
}


public function openRoomToday(Request $request, $id)
{
    $date = $request->input('date');

    // Veriyi sil
    Availability::where('room_id', $id)
        ->where('date', $date)
        ->delete();

    // Odayı açma işlemlerini burada gerçekleştirin
    $room = Room::find($id);
    if ($room) {
        // Odayı açma işlemleri burada gerçekleştirilebilir
        $room->update(['status' => 'open']);

        return response()->json(['message' => 'Oda başarıyla açıldı ve Availability tablosundaki kayıt silindi.']);
    }

    return response()->json(['message' => 'Oda bulunamadı.'], 404);
}


public function getRoomsForToday($hotelId)
{
    // $hotelId parametresini kullan
    $today = now()->format('Y-m-d');

    // Otela ait bugün tarihli bir veri var mı kontrolü
    $availabilities = Availability::where('hotel_id', $hotelId)
        ->whereDate('date', $today)
        ->get();

    return response()->json(['availabilities' => $availabilities]);
}



}
