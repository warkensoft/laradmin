<?php

Route::group([
	'prefix'=>config('laradmin.adminpath'),
	'middleware'=>config('laradmin.middleware'),
	'namespace'=>'Warkensoft\\Laradmin\\Controllers',
], function () {

	Route::get('/', function () { return redirect()->to('/' . config('laradmin.adminpath') . '/dashboard/'); });
	Route::get('dashboard', 'DashboardController@index')
	     ->name('laradmin.dashboard');

	\Warkensoft\Laradmin\Services\LaradminService::Routes();

});
