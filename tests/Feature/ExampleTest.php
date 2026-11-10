<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_root_returns_not_found(): void
    {
        $this->getJson('/')->assertNotFound();
    }
}
