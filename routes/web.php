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
    	
			
		Route::get('/', 'SchemaRS\Web\AuthController@index')->name('login');
		
		Route::post('auth', 'SchemaRS\Web\AuthController@authenticate')->name('authenticate');
		
		Route::post('change-password', 'SchemaRS\Web\AuthController@changePassword')->name('ChangePassword');
		
		Route::get('logout', 'SchemaRS\Web\AuthController@logout')->name('logout');

		
		Route::group(['middleware' => ['auth', 'user.privilege']], function ()
		{
			Route::get('dashboard', 'SchemaRS\Web\DashboardController@index')->name('CmsDashboard');

			// Registration pages route
			Route::group(array('prefix' => 'registration' ), function()
			{
				Route::get('/', 'SchemaRS\Web\Pages\RegistrationController@index')->name('RegistrationIndex');
				Route::get('data', 'SchemaRS\Web\Pages\RegistrationController@getData')->name('getDataRegistration');
				Route::get('search', 'SchemaRS\Web\Pages\RegistrationController@searchData')->name('searchDataRegistration');
				Route::get('show', 'SchemaRS\Web\Pages\RegistrationController@showData')->name('showDataPatientRegistration');
				Route::post('store', 'SchemaRS\Web\Pages\RegistrationController@storeData')->name('storeDataRegistration');
			});
		});
	});
});
