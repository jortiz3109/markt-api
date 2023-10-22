<?php

namespace App\Actions\ShoppingLists;

use App\Models\Shop;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Str;

class Store
{
    public function handle(array $data, User $user): ShoppingList
    {
        $shop = Shop::select(['id', 'name'])->find($data['shop']);

        $shoppingList = new ShoppingList();
        $shoppingList->setAttribute('uuid', Str::orderedUuid());
        $shoppingList->setAttribute('shop_id', $shop->getKey());
        $shoppingList->setAttribute('user_id', $user->getKey());
        $shoppingList->save();

        $shoppingList->setRelation('shop', $shop);
        $shoppingList->setRelation('user', $user);

        return $shoppingList->refresh();
    }
}
