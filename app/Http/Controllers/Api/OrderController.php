<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function show(Request $request,$customerId, $startDate=null, $endDate=null)
    {
    	$response = [
				'status'  =>'error',
				'message' => 'ok',
				'data'    => null,
	        ];

    	if($startDate!=null && $endDate!=null){
			$request['customerId'] = $customerId;
			$request['startDate']  = $startDate;
			$request['endDate']    = $endDate;
			$rules = [
				'customerId' => 'required',
				'startDate'  => 'required|date|date_format:Y-m-d',
				'endDate'    => 'required|date|after:startDate|date_format:Y-m-d'
			];

			$this->validate($request, $rules);
		}

		$orders = Order::where("customer_id",$customerId)
						->orderBy('creation_date', 'asc')
						->get();
        if($startDate!=null && $endDate!=null){
			$orders = $orders->whereBetween('creation_date', [$startDate, $endDate]);
		}
		if(count($orders) == 0){
	        $response['message'] = "No orders.";
            return response()->json($response, 404);
        }
		$response['status']  = 'success';
		$response['data']    = $orders;
        return response()->json($response, 200);
    }


    public function store(Request $request)
    {
    	$response = [
				'status'  =>'error',
				'message' => 'ok',
				'data'    => null,
	        ];
        $rules = [
			'customerId'      => 'required',
			'deliveryAddress' => 'required',
			'orderProducts'   => 'required'
        ];

        $this->validate($request, $rules);

		$data     = $request->json()->all();

		$customer = Customer::findOrFail($data['customerId']);

        // Order Products
        $orderProducts = $data['orderProducts'];
		// Available products for customer
		$product_customer     = $customer->products;
		$availableProducts    = array();
		$notAvailableProducts = array();
		$quantity             = 0;
		$totalPrice           = 0;

        foreach ($orderProducts as $element){
    		$product = $product_customer->where('product_id',$element['productId'])->values();
            if(count($product)){
				$element['product_description'] = $product[0]->product_description;
				$element['price']               = $product[0]->price;
				$availableProducts[]            = $element;
				$quantity                       += $element['quantity'];
				$totalPrice                     += ($product[0]->price*$element['quantity']);
			}else{
				$notAvailableProducts[]         = $element;
			}
        }

        if(count($availableProducts) == 0 || count($notAvailableProducts) > 0){
        	$response['message'] = 'The order has products not allowed for the customer';
            return response()->json($response, 422);
        }
        if(count($availableProducts) > 5 || $quantity > 5){
        	$response['message'] = 'The amount of products must be less or equal to 5';
            return response()->json($response, 422);
        }

        $order = Order::create([
			"customer_id"      => $customer->customer_id,
			"creation_date"    => date('Y-m-d'),
			"delivery_address" => $data['deliveryAddress'],
			"total"            => $totalPrice
        ]);

        foreach($availableProducts as $product){
            $orderDetail = OrderDetail::create([
				"product_description" => $product['product_description'],
				"price"               => $product['price'],
				"order_id"            => $order->order_id,
				"quantity"            => $product['quantity'],
	        ]);
        }

        $response['status']  = 'success';
		$response['data']    = $order;
        return response()->json($order, 201);
    }

}
