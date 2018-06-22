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
    if(Auth::guest()) {
        return redirect('/login');
    }
    return view('welcome');
});

Route::get('tutorials/{tutorials}/enroll', ['uses' => 'TutorialsController@enroll', 'as' => 'tutorials.enroll']);
Route::resource('tutorials','TutorialsController');

Route::resource('guardians','GuardiansController');
Route::resource('students','StudentsController');

Route::resource('enrolled','EnrolledController');

Route::get('products/{product}/buy', ['uses' => 'ProductsExtraController@buy', 'as' => 'products.buy']);
Route::get('products/{product}/add_stock', ['uses' => 'ProductsExtraController@add_stock', 'as' => 'products.add_stock']);
Route::match('put', 'products/{product}', ['uses' => 'ProductsExtraController@update_quantity', 'as' => 'products.update_quantity']);
Route::resource('products','ProductsController');

Route::resources([
    'flight_tickets' => 'FlightTicketsController',
    'airline_companies' => 'AirlineCompaniesController',
    'product_log' => 'ProductLogController',
    'buyers' => 'BuyersController',
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
