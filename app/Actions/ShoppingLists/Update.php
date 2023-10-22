<?php

namespace App\Actions\ShoppingLists;

use App\Models\Shop;
use App\Models\ShoppingList;
use App\Models\User;

class Update
{
    public function handle(array $data, User $user): ShoppingList
    {
        $shop = Shop::select(['id', 'name'])->find($data['shop']);

        $shoppingList = ;

        $shoppingList->setAttribute('shop_id', $shop->getKey());
        $shoppingList->save();

        $shoppingList->setRelation('shop', $shop);
        $shoppingList->setRelation('user', $request->user());
    }
}
