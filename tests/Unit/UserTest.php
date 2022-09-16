<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Checks if the user exists, 
     * this will also show if the "Functionality to be ported" 
     * at number 1 will be working
     *
     * @return void
     */
    public function test_check_user_exist()
    {
        $response = $this->get('/2');
        $response->assertStatus(200);
    }
}
