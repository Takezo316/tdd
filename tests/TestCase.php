<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function signIn($user = null){
        $this->actingAs($user ?: User::factory()->create());
    }
}
