<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup-activate/{token}', 'AuthController@signupActivate')->name('active_account');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('current-user', 'AuthController@currentUser');
    Route::resource('roles', 'Roles\RoleController');
    Route::resource('shipment-types', 'ShipmentTypes\ShipmentTypeController');
    Route::resource('confirm-types', 'ConfirmTypes\ConfirmTypeController');
});

Route::group(['namespace' => 'Organisations'], function () {
    Route::get('organisation-cities', 'OrganisationCityController@index');
});
