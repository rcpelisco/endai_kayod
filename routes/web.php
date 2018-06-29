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


Route::resources([
    'tutorials' => 'TutorialsController',
    'guardians' => 'GuardiansController',
    'students' => 'StudentsController',
    'endrolled' => 'EnrolledController',
    'flight_tickets' => 'FlightTicketsController',
    'airline_companies' => 'AirlineCompaniesController',
    'buyers' => 'BuyersController',
    'products' => 'ProductsController',
    'product_log' => 'ProductLogController',
]);

Route::get('buyers/pay_debt/{id}', ['uses' => 'ProductsExtraController@pay_debt', 'as' => 'students.pay_tutorial']);
Route::get('products/{product}/buy', ['uses' => 'ProductsExtraController@buy', 'as' => 'products.buy']);
Route::get('products/{product}/add_stock', ['uses' => 'ProductsExtraController@add_stock', 'as' => 'products.add_stock']);
Route::put('products/{product}/update_quantity', ['uses' => 'ProductsExtraController@update_quantity', 'as' => 'products.update_quantity']);
Route::get('products/{product}/edit_history', ['uses' => 'ProductEditHistoryController@show', 'as' => 'products.edit_history']);
Route::get('students/enrolled/{id}', ['uses' => 'StudentExtraController@pay_tutorial', 'as' => 'students.pay_tutorial']);
Route::get('tutorials/{tutorials}/enroll', ['uses' => 'TutorialsExtraController@enroll', 'as' => 'tutorials.enroll']);
Route::post('tutorials/drop', ['uses' => 'TutorialsExtraController@drop', 'as' => 'tutorials.drop']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
