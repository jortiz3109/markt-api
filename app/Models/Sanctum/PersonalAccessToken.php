<?php

namespace App\Models\Sanctum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'ip_address',
        'expires_at',
    ];

    public static function findToken($token): PersonalAccessToken|null
    {
        $token = parent::findToken($token);

        if ($token && $token->isValid()) {
            return $token;
        }

        return null;
    }

    private function isValid(): bool
    {
        return $this->getAttribute('ip_address') === request()->ip();
    }
}
