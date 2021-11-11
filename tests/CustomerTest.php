<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    public function testAllDataCustomers()
    {
    $response = $this->json('GET', 'api/customers');

    return response()->json('success', 201);

    }

    public function testIdDataCustomers(){

        $this->json('GET', 'api/customers/1', ['Accept' => 'application/json']);
        
        return response()->json('success', 201);
    }

    public function testPostCustomers(){

         $customerData = [
            "name" => "John Doe",
            "alamat" => "Jakarta",
            "no_hp" => "12345",
        ];

        $this->post('api/customers', $customerData, ['Accept' => 'application/json']);
         return response()->json('success', 201);
    }

    public function testUpdateCustomers(){

         $customerData = [
            "name" => "John Doe",
            "alamat" => "Jakarta",
            "no_hp" => "12345",
        ];

        $this->put('api/customers/1', $customerData, ['Accept' => 'application/json']);
         return response()->json('success', 201);
    }

      public function testDeleteCustomers(){

        $this->delete('api/customers/1', ['Accept' => 'application/json']);
         return response()->json('success', 201);
    }

}
