<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/services', function () {
//     return view('services');
// });

Route::resource('tutorials','TutorialsController');
Route::resource('guardians','GuardiansController');
Route::resource('students','StudentsController');
Route::resource('enrolled','EnrolledController');

Route::resource('products','ProductsController');
Route::get('products/{product}/buy', ['uses' => 'ProductsController@buy', 'as' => 'products.buy']);
Route::match(['put', 'patch'],'products/{product}', 
['uses' => 'ProductsController@updateQuantity', 'as' => 'products.updateQuantity']);

Route::resource('flight_tickets','FlightTicketsController');
Route::resource('airline_companies','AirlineCompaniesController');