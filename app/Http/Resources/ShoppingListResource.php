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
            'uuid' => $this->resource->uuid,
            'is_paid' => $this->resource->isPaid(),
            'total' => $this->whenAggregated(
                relationship: 'items',
                column: 'price',
                aggregate: 'sum',
                value: fn ($total) => Money::decimal($total),
                default: 0
            ),
            'items' => $this->whenCounted('items'),
            'created_at' => $this->resource->created_at,
            'paid_at' => $this->resource->paid_at,
            'shop' => ShopResource::make($this->whenLoaded('shop')),
        ];
    }
}
