<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Reservation;
use Hash;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
     public function getCustomerOrders()
    {
        // Kullanıcı token'ını kontrol et
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            // Token kontrolü başarısız ise hata döndür
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Kullanıcının rezervasyonlarını çek
        $customerOrders = $customer->reservations()
            ->where('status', 'completed')
            ->with('hotel') // Eager loading kullanarak N+1 sorgu sorununu önleme
            ->orderBy('hotel_id')
            ->orderByDesc('booking_date')
            ->get();

        // Sonuçları formatla
        $result = $customerOrders->map(function ($order) {
            return [
                'hotel_id' => $order->hotel->id,
                'hotel_name' => $order->hotel->hotel_name,
                'hotel_photo' => $order->hotel->hotel_photo,
                'booking_date' => $order->booking_date,
                'paid_amount' => $order->paid_amount,
            ];
        });

        return response()->json(['data' => $result], 200);
    }




public function changePassword(Request $request, $customerId)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    // Gelen customer ID'si ile müşteriyi bul
    $customer = Customer::find($customerId);

    // Müşteri var mı kontrol et
    if (!$customer) {
        return response()->json(['error' => 'Customer not found.'], 404);
    }

    // Giriş yapan kullanıcı mı kontrol et
    // Bu adım, sadece kullanıcı kendi şifresini değiştirebilirken kullanılır
    // Eğer farklı bir yetkilendirme mantığı kullanacaksanız bu kısmı uyarlayabilirsiniz
    if ($customer->id !== auth('customer')->user()->id) {
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    // Mevcut şifre doğrulaması
    if (!Hash::check($request->input('current_password'), $customer->password)) {
        return response()->json(['error' => 'Current password is incorrect.'], 401);
    }

    // Yeni şifreyi güncelle
    $customer->password = Hash::make($request->input('new_password'));
    $customer->save();

    return response()->json(['message' => 'Password changed successfully.']);
}

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:120',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'photo' => 'nullable|string|max:255',
            'birth' => 'nullable|date',
        ]);

        $customer = auth('customer')->user();
 
        $customer->update([
            'name' => 'nullable|string|max:120',
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'zip' => $request->input('zip'),
            'photo' => $request->input('photo'),
            'birth' => $request->input('birth'),
        ]);

        return response()->json(['message' => 'Profile updated successfully.']);
    }
}
