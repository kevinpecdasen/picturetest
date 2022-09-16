<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_user_exist()
    {
        $response = $this->get('/2');
        $response->assertStatus(200);
    }
}
