<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @var \Illuminate\Routing\Router $router
 */

$router->get("dashboard/payments","DashboardPaymentsController@index");
$router->get("dashboard/customers","DashboardCustomersController@index");

$router->get("customers","CustomersController@index");
$router->post("customers","CustomersController@store");
$router->get("customers/{id}","CustomersController@show");
$router->post("customers/{id}","CustomersController@update");
$router->delete("customers/{id}","CustomersController@destroy");

$router->get("countries","CountriesController@index");

$router->get("payments","PaymentsController@index");

