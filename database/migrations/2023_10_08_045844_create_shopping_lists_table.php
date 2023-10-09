<?php

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->bigInteger('total')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->foreignIdFor(Shop::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_lists');
    }
};
