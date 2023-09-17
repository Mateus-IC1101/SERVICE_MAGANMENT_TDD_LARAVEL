<?php

namespace Tests\Feature\API;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use PhpParser\Node\Expr\Instanceof_;
use Tests\TestCase;

class CustomersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customers_all_api(): void
    {
        Customer::factory(3)->create();

        $response = $this->get('/api/customers');
        $response->assertStatus(200);

        $jsonCustomers = $response->json()['customers'];

        $columnsToCheck = [
            'id' => 'id',
            'street' => 'street',
        ];

        $this->assertCount(3, $jsonCustomers);

        foreach($jsonCustomers as $customer){

            $customerModel = new Customer([$customer]);
            $this->assertInstanceOf(Customer::class, $customerModel);

            $this->assertArrayHasKey($columnsToCheck['street'], $customer);
            $this->assertIsString($customer['street']);

            $this->assertArrayHasKey($columnsToCheck['id'], $customer);
            $this->assertIsInt($customer['id']);


        }


    }
}
