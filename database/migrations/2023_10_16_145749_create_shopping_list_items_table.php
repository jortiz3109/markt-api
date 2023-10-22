<?php

use App\Models\ShoppingList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shopping_list_items', function (Blueprint $table) {
            $table->id();
            $table->string('item', 120);
            $table->unsignedBigInteger('price');
            $table->boolean('in_offer')->default(false);
            $table->foreignIdFor(ShoppingList::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_list_items');
    }
};
