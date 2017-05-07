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

Route::group(['middleware' => ['web']], function ()
{
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('DOMAIN_PREFIX') . env('APP_DOMAIN')], function()
    {
    	Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localize' ]], function()
		{
			Route::get('/', 'SchemaRS\Web\AuthController@index')->name('login');
			
			Route::post('auth', 'SchemaRS\Web\AuthController@authenticate')->name('authenticate');
			
			Route::post('change-password', 'SchemaRS\Web\AuthController@changePassword')->name('ChangePassword');
			
			Route::get('logout', 'SchemaRS\Web\AuthController@logout')->name('logout');
			
			Route::get('dashboard', 'SchemaRS\Web\DashboardController@index')->name('CmsDashboard');

			// Patient Uri
			Route::group(array('prefix' => 'patient' ), function()
			{
				Route::get('/', 'SchemaRS\Web\Pages\PatientController@index')->name('PatientIndex');
				Route::get('data', 'SchemaRS\Web\Pages\PatientController@getData')->name('getDataPatient');
			});
	    });
	});
});
