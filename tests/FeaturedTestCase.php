<?php

namespace Tests;

use Tests\TestCase;



abstract class FeaturedTestCase extends TestCase
{
    public function assertResponseStatus($response, $expectedHttpCode, $message = "Response status mismatch")
    {
        $this->assertTrue(
            $response->getStatusCode() === $expectedHttpCode,
            $message
        );
    }
}
