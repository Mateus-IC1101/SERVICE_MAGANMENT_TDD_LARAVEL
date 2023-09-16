<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAllController extends Controller
{

    public function __invoke(Customer $customer)
    {
        $customer->factory(3)->create();

        $customers = $customer->all();

        return response()->json([
            'customers' => $customers
        ]);
    }
}
