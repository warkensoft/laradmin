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
	'middleware'   => ['auth'],

	// The base path for the laradmin area
	'adminpath'    => 'laradmin',

	'layout' => 'laradmin::layouts.admin',

	// How many items per page are shown on CRUD indexes
	'index-length' => 10,

	// Models that are CRUDable
	'crudable'     => [

		'\\App\\User' => [
			'path'       => 'users',
			'route'      => 'users',
//			'controller' => 'UsersController',
			'nav_title'  => 'Users',
			'plural'     => 'Users',
			'singular'   => 'User',
			'fields'     => [
				[
					'field'       => 'name',
					'type'        => 'input',
					'label'       => 'User Name',
					'placeholder' => 'Somebody Smith',
					'default'     => '',
				],
				[
					'field'       => 'email',
					'type'        => 'input',
					'label'       => 'Email Address',
					'placeholder' => 'somebody@example.com',
					'default'     => '',
				],
				[
					'field'       => 'password',
					'type'        => 'password',
					'label'       => 'Password',
					'placeholder' => 'Enter password here...',
					'default'     => '',
				],
				[
					'field'       => 'password_confirmation',
					'type'        => 'password',
					'label'       => 'Confirm Password',
					'placeholder' => 'Repeat password here...',
					'default'     => '',
				],
			],
			'index'      => [
				'id'    => 'ID',
				'name'  => 'Name',
				'email' => 'Email Address',
			],
			'rules'      => [
				'name'     => 'required',
				'email'    => 'required',
				'password' => 'confirmed',
			],
		],  // End of User definition

	],

];
