<?php

namespace App\Http\Controllers;

use App\Actions\ShoppingLists\Store;
use App\Actions\ShoppingLists\Update;
use App\Http\Requests\ShoppingLists\IndexRequest;
use App\Http\Requests\ShoppingLists\StoreRequest;
use App\Http\Requests\ShoppingLists\UpdateRequest;
use App\Http\Resources\ShoppingListResource;
use App\Models\ShoppingList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShoppingListController extends Controller
{
    public function index(IndexRequest $request): ResourceCollection
    {
        $shoppingLists = ShoppingList::with('shop:id,name')
            ->withCount('items')
            ->where(['user_id' => Auth::id()])
            ->paginate();

        return ShoppingListResource::collection($shoppingLists);
    }

    public function store(StoreRequest $request, Store $action): ShoppingListResource
    {
        $shoppingList = $action->handle($request->validated(), $request->user());
        return ShoppingListResource::make($shoppingList);
    }

    public function update(UpdateRequest $request, Update $action): ShoppingListResource
    {
        $shoppingList = $action->handle($request->validated(), $request->user());

        return ShoppingListResource::make($shoppingList);
    }

    public function show(string $uuid): ShoppingListResource
    {
        $shoppingList = ShoppingList::with('shop:id,name')
            ->withCount('items')
            ->where([
                'user_id' => Auth::id(),
                'uuid' => $uuid
            ])->firstOrFail();

        return ShoppingListResource::make($shoppingList);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $shoppingList = ShoppingList::where([
            'user_id' => Auth::id(),
            'uuid' => $uuid
        ])->firstOrFail();

        $shoppingList->items()->delete();
        $shoppingList->delete();

        return response()->json(['message' => 'Success']);
    }
}
