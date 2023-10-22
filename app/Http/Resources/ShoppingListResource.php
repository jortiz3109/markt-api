<?php

namespace App\Http\Resources;

use App\Helpers\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'total' => Money::format($this->total),
            'is_paid' => $this->isPaid(),
            'paid_at' => $this->paid_at,
            'items_count' => $this->whenCounted('items'),
            'shop' => ShopResource::make($this->whenLoaded('shop')),
        ];
    }
}
