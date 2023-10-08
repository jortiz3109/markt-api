<?php

namespace App\Listeners;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\Events\TokenAuthenticated;

class ExtendPersonalAccessToken
{
    public function handle(TokenAuthenticated $event): void
    {
        $event->token->update([
            'expires_at' => Carbon::now()->addMinutes(config('sanctum.lifetime'))
        ]);
    }
}
