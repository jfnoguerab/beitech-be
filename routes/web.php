<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {

	//Show all customers
	$router->get('/customers', 'Api\CustomerController@index');
	$router->get('/customers/{customerId}', 'Api\CustomerController@show');
	//Filter customer orders by start date and end date
	$router->get('/customers/{customerId}/orders[/{startDate}/{endDate}]', 'Api\OrderController@show');
	//Save Order
	$router->post('/orders', 'Api\OrderController@store');

});