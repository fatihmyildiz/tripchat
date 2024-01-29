<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Room;

class CheckRoomOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $userHotelId = auth()->user()->hotel_id;

        $roomId = $request->route('room_id');
        $room = Room::find($roomId);

        if (!$room || $room->hotel_id !== $userHotelId) {
            abort(404);
        }

        return $next($request);
    }
}
