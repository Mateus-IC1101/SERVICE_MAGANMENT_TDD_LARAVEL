<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAllController extends Controller
{

    public function __invoke(Customer $customer)
    {
        $customers = $customer->select(['id', 'street'])->get();

        return response()->json([
            'customers' => $customers
        ]);
    }
}
