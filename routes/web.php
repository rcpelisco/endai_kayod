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
})->name('welcome');


Route::resources([
    'tutorials' => 'TutorialsController',
    'guardians' => 'GuardiansController',
    'students' => 'StudentsController',
    'enrolled' => 'EnrolledController',
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
Route::get('students/get_tutorial/{id}', ['uses' => 'StudentExtraController@get_tutorial', 'as' => 'students.get_tutorial']);
Route::get('students/get_tutorial_due/{id}', ['uses' => 'StudentExtraController@get_tutorial_due', 'as' => 'students.get_tutorial_due']);
Route::post('students/pay_tutorial', ['uses' => 'StudentExtraController@pay_tutorial', 'as' => 'students.pay_tutorial']);
Route::get('students/re_enroll/{enroll_id}', ['uses' => 'StudentExtraController@re_enroll', 'as' => 'students.re_enroll']);
Route::get('tutorials/{tutorial}/enroll', ['uses' => 'TutorialsExtraController@enroll', 'as' => 'tutorials.enroll']);
Route::post('tutorials/drop', ['uses' => 'TutorialsExtraController@drop', 'as' => 'tutorials.drop']);
Route::post('tutorials/deduct_session', ['uses' => 'TutorialsExtraController@deduct_session', 'as' => 'tutorials.deduct_session']);

Route::get('boarding_house', ['uses' => 'BoardingHouseController@index', 'as' => 'boarding_house.index']);
Route::get('boarding_house/create', ['uses' => 'BoardingHouseController@create', 'as' => 'boarding_house.create']);
Route::post('boarding_house', ['uses' => 'BoardingHouseController@store', 'as' => 'boarding_house.store']);
Route::get('boarding_house/{room}', ['uses' => 'BoardingHouseController@show', 'as' => 'boarding_house.show']);
Route::get('boarding_house/{room}/edit', ['uses' => 'BoardingHouseController@edit', 'as' => 'boarding_house.edit']);
Route::delete('boarding_house/{room}', ['uses' => 'BoardingHouseController@destroy', 'as' => 'boarding_house.destroy']);
Route::post('boarding_house/{room}/create_boarder', ['uses' => 'BoardingHouseController@createBoarder', 'as' => 'boarding_house.create_boarder']);

Route::get('boarders', ['uses' => 'BoardersController@index', 'as' => 'boarders.index']);
Route::get('boarders/create', ['uses' => 'BoardersController@create', 'as' => 'boarders.create']);
Route::post('boarders', ['uses' => 'BoardersController@store', 'as' => 'boarders.store']);
Route::get('boarders/{boarder}', ['uses' => 'BoardersController@show', 'as' => 'boarders.show']);
Route::delete('boarders/{boarder}', ['uses' => 'BoardersController@destroy', 'as' => 'boarders.destroy']);
Route::post('boarders/{boarder}/pay', ['uses' => 'PaymentsController@store', 'as' => 'boarders.pay']);

Route::get('reservations', ['uses' => 'ReservationsController@index', 'as' => 'reservation.index']);
Route::post('reservations', ['uses' => 'ReservationsController@store', 'as' => 'reservation.store']);
Route::get('reservations/events', ['uses' => 'ReservationsController@events', 'as' => 'reservation.events']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
