<?php

namespace Tests\Feature;

use Tests\Cases\TestCaseFeature;

class ExampleTest extends TestCaseFeature
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
