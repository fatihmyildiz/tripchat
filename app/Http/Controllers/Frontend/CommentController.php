<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use App\Http\Resources\ReviewResource;

class CommentController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'customer_id' => 'required|exists:customers,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // orders tablosunda ilgili müşterinin belirli bir otelde rezervasyonu olup olmadığını ve durumunu kontrol et
        $order = Order::where('hotel_id', $request->hotel_id)
            ->where('customer_id', $request->customer_id)
            ->whereIn('status', ['completed', 'hidden'])
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Bu otelde tamamlanmış bir rezervasyonunuz bulunmamaktadır.'], 403);
        }

        $review = Review::create([
            'hotel_id' => $request->hotel_id,
            'customer_id' => $request->customer_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => 'Yorumunuz başarıyla eklendi.', 'review' => $review], 201);
    }



    public function getReviews($id)
    {
        $reviews = Review::where('hotel_id', $id)->where('status', 'active')->get();
        return ReviewResource::collection($reviews);
    }


    public function getUserReviews($customerId)
{
    $pendingReviews = Review::where('customer_id', $customerId)->where('status', 'pending')->get();
    $activeReviews = Review::where('customer_id', $customerId)->where('status', 'active')->get();

    return response()->json([
        'pending_reviews' => ReviewResource::collection($pendingReviews),
        'active_reviews' => ReviewResource::collection($activeReviews),
    ]);
}
}
