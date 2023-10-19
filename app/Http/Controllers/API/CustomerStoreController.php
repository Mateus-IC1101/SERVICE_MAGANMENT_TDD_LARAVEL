<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerStoreController extends Controller
{
    public function __invoke(Request $request, Customer $customer)
    {
        $customer = $customer->create(
            $request->all()
        );

        return response()->json([
            'customer' => $customer
        ]);
    }
}
