<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'rating' => $this->rating,
            'author' => $this->customer->name, // Veya customer tablosundaki diğer bir özelliği ekleyebilirsiniz.
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
