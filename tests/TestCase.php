<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function withJWT($user = null): User
    {
        /* @var User $user */
        if (!isset($user)) {
            $user = User::factory()->create();
        }
        auth()->setUser($user);
        $this->actingAs($user);

        return $user;
    }
}
