<?php

namespace Tests\Feature\ShoppingLists;

use App\Models\Shop;
use App\Models\ShoppingList;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\TestCases\IndexTestCase;

class IndexTest extends IndexTestCase
{
    protected const URL = '/api/shopping-lists';

    public function testUserCanListTheirOwnShoppingLists(): void
    {
        $user = $this->createUser();
        ShoppingList::factory()
            ->for($user)
            ->for(Shop::factory()->create())
            ->create(['total' => 100]);

        Sanctum::actingAs($user);

        $response = $this->getJson(self::URL);

        $response->assertOk();
        $response->assertJson(
            fn(AssertableJson $json) =>
                $json->hasAll(['data', 'meta', 'links'])
                     ->has('data.0', fn(AssertableJson $shoppingList) =>
                        $shoppingList->where('total', 100)
                            ->etc()
                     )
        );
    }
}
