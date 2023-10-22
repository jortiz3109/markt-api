<?php

namespace App\Http\Requests\ShoppingLists;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends StoreRequest
{
    protected function passedValidation(): void
    {
        parent::passedValidation();

        $shoppingList = ShoppingList::where([
            'user_id' => $this->user()->getKey(),
            'uuid' => $this->route('uuid')
        ])->firstOrFail();

        $this->route()->setParameter('shoppingList', $shoppingList);
    }
}
