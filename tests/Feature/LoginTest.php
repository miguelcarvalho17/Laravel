<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_with_a_not_registered_account()

    {
        $faker = \Faker\Factory::create();
        $email = $faker->email();
        $this->call('POST', 'login', [
            'email' => $email,
            'password' => 'password',
            '_token' => csrf_token()
        ]);
        $this->notSeeInDatabase('users', ['email' => $email]);
    }
}
