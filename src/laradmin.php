<?php

return [

	/*
	|--------------------------------------------------------------------------
	| CMS Configuration
	|--------------------------------------------------------------------------
	|
	| Configuration variables for customizing the functionality of the CMS
	|
	*/

	// Middleware required to access the laradmin area
	'middleware' => [ 'auth' ],

	// The base path for the laradmin area
	'adminpath'  => 'laradmin',

	'layout'       => 'laradmin::layouts.admin',

	// How many items per page are shown on CRUD indexes
	'index-length' => 10,

	// Models that are CRUDable
	'crudable'     => [

		'\\App\\User' => [
			'path'      => 'users',
			'route'     => 'users',
			//			'controller' => 'UsersController',
			'nav_title' => 'Users',
			'plural'    => 'Users',
			'singular'  => 'User',
			'fields'    => [
				\Warkensoft\Laradmin\Fields\Input::Setup([
					'name'        => 'name',
					'label'       => 'User Name',
					'placeholder' => 'Somebody Smith',
					'default'     => '',
					'rules'       => 'required',
				]),
				\Warkensoft\Laradmin\Fields\Input::Setup([
					'name'        => 'email',
					'label'       => 'Email Address',
					'placeholder' => 'somebody@example.com',
					'default'     => '',
					'rules'       => 'required',
				]),
				\Warkensoft\Laradmin\Fields\Password::Setup([
					'name'        => 'password',
					'label'       => 'Password',
					'placeholder' => 'Enter password here...',
					'default'     => '',
					'rules'       => 'confirmed',
				]),
				\Warkensoft\Laradmin\Fields\Password::Setup([
					'name'        => 'password_confirmation',
					'label'       => 'Confirm Password',
					'placeholder' => 'Repeat password here...',
					'default'     => '',
					'rules'       => '',
				]),
			],
			'index'     => [
				'id'    => 'ID',
				'name'  => 'Name',
				'email' => 'Email Address',
			],
		],  // End of User definition

	],

];
