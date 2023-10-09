<?php

namespace Tests\Feature\TestCases;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

abstract class IndexTestCase extends TestCase
{
    use RefreshDatabase;
    public function testUnauthenticatedUserCantAccess(): void
    {
        $response = $this->getJson(static::URL);

        $response->assertUnauthorized();
    }

    public function testExpiredUserTokenCantAccess(): void
    {

        $response = $this->getJson(static::URL);

        $response->assertUnauthorized();
    }

    public function testAuthenticatedUserCanAccess(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        $response = $this->getJson(static::URL);

        $response->assertOk();
    }
}
