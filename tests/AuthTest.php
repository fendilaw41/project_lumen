<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
  public function testSuccessfulLogin()
    {
        
        $loginData = ['email' => 'fendilaw12@gmail.com', 'password' => 'password'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json']);
        return response()->json('success', 201);

    }

     public function testSuccessfulRegistration()
    {
        $userData = [
           'email' => 'fendilaw12@gmail.com',
           'password' => 'password'
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json']);

         return response()->json('success', 201);
    }
}
