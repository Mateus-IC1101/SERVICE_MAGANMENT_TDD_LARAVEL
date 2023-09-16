<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CustomersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customers_all_api(): void
    {

        $response = $this->get('/api/customers');
        $response->assertStatus(200);
        $json_customers = $response->json()['customers'];

        foreach($json_customers as $customer){
            dd($customer);
            $this->assertIsInt($customer['id']);
            $this->assertIsString($customer['street']);
        }
    }
}
