<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->ipAddress()->nullable()->after('abilities');
        });

        DB::table('personal_access_tokens')->update(['ip_address' => '127.0.0.1']);

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->ipAddress()->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
};
