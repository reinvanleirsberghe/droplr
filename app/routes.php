<?php

/*
 * Pages
 */
Route::get('/', [
	'as'   => 'home',
	'uses' => 'PagesController@home'
]);

/*
 * Sign Up
 */
Route::get('signup', [
	'as'   => 'registration_path',
	'uses' => 'RegistrationController@create'
]);

Route::post('signup', [
	'as'   => 'registration_path',
	'uses' => 'RegistrationController@store'
]);

/*
 * User
 */
Route::get('user/account', [
	'as'   => 'user_account_path',
	'uses' => 'AccountController@index'
]);

Route::post('user/account', [
	'as'   => 'user_account_path',
	'uses' => 'AccountController@store'
]);

Route::get('user/drops', [
	'as'   => 'user_drops_path',
	'uses' => 'AccountController@drops'
]);

/*
 * Drops
 */
Route::get('/drops', [
	'as'   => 'drops_path',
	'uses' => 'DropController@index'
]);

Route::get('/drops/add', [
	'as'   => 'drops_add_path',
	'uses' => 'DropController@create'
]);

Route::post('/drops/add', [
	'as'   => 'drops_add_path',
	'uses' => 'DropController@store'
]);

Route::get('/drops/edit/{id}', [
	'as'   => 'drops_edit_path',
	'uses' => 'DropController@edit'
])->where('id', '[0-9]+');

Route::get('/drops/info/{id}', [
	'as'   => 'drops_info_path',
	'uses' => 'DropController@editInfo'
])->where('id', '[0-9]+');

Route::post('/drops/info/{id}', [
	'as'   => 'drops_info_path',
	'uses' => 'DropController@update'
])->where('id', '[0-9]+');

Route::delete('/drops/delete/{id}', [
	'as'   => 'drops_delete_path',
	'uses' => 'DropController@destroy'
])->where('id', '[0-9]+');

Route::post('/drops/sortmarkers/{id}', [
	'as'   => 'drops_sort_path',
	'uses' => 'DropController@sortMarkers'
])->where('id', '[0-9]+');

/*
 * Markers
 */
Route::post('/marker/add', [
	'as'   => 'marker_add_path',
	'uses' => 'MarkerController@store'
]);

Route::delete('/marker/delete/{id}', [
	'as'   => 'marker_delete_path',
	'uses' => 'MarkerController@destroy'
])->where('id', '[0-9]+');

Route::post('/marker/updatelatlng/{id}', [
	'as'   => 'marker_updatelatlng_path',
	'uses' => 'MarkerController@updateLatLng'
])->where('id', '[0-9]+');

Route::post('/marker/updateinfo/{id}', [
	'as'   => 'marker_updateinfo_path',
	'uses' => 'MarkerController@updateInfo'
])->where('id', '[0-9]+');

Route::get('/marker/show/{id}', [
	'as'   => 'marker_show_path',
	'uses' => 'MarkerController@show'
])->where('id', '[0-9]+');

/*
 * Sessions
 */
Route::get('login', [
	'as'   => 'login_path',
	'uses' => 'SessionsController@create'
]);

Route::post('login', [
	'as'   => 'login_path',
	'uses' => 'SessionsController@store'
]);

Route::get('logout', [
	'as'   => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

/*
 * API
 */
//Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
Route::group(array('prefix' => 'api/v1'), function()
{
	Route::get('drop', [
		'as'   => 'api_v1_drop_path',
		'uses' => 'APIv1DropController@index'
	]);

	Route::get('drop/{id}', [
		'as'   => 'api_v1_dropshow_path',
		'uses' => 'APIv1DropController@show'
	]);
});

/*
 * Reminders
 */
Route: Route::controller('password', 'RemindersController');

/*
 * Test
 */
Route::get('test', [
	'as'   => 'test_path',
	'uses' => 'TestController@index'
]);