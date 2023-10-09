<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShoppingListResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    public function index(): ResourceCollection
    {
        $shoppingLists = Auth::user()->shoppingLists()->with('shop')->paginate();

        return ShoppingListResource::collection($shoppingLists);
    }
}
