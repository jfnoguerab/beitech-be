<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {

        $response = [
				'status'  =>'success',
				'message' => 'ok',
				'data'    => $customers
        ];
        $customers = Customer::all();
        return response()->json($response, 200);
    }

    public function show($customerId)
    {
    	$response = [
				'status'  =>'error',
				'message' => 'ok',
				'data'    => null,
	        ];
        $customer = Customer::find($customerId);
        if(!$customer){
        	$response['message'] = 'Customer not found';
            return response()->json($response, 404);
        }
        $response['status']  = 'success';
		$response['data']    = $customer;
        return response()->json($response, 200);
    }

}
