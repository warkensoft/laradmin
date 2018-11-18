<?php

Route::group(['middleware' => ['web']], function () {

	Route::group([
		'prefix'=>config('laradmin.adminpath'),
		'middleware'=>config('laradmin.middleware'),
	], function () {

		Route::get('/', function () { return redirect()->to('/' . config('laradmin.adminpath') . '/dashboard/'); });
		Route::get('dashboard', 'Warkensoft\\Laradmin\\Controllers\\DashboardController@index')
		     ->name(config('laradmin.adminpath') . '.dashboard');

		Route::post('upload', 'Warkensoft\\Laradmin\\Controllers\\UploadController@store')
		     ->name(config('laradmin.adminpath') . '.upload');

		Laradmin::Routes();

	});

});
