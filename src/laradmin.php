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

//		// Sample entry for a standard laravel user record.
//		'\\App\\Models\\User' => [
//			'path'      => 'users', // The path to the model under /laradmin/
//			'route'     => 'users', // The route name used for the model
//			'nav_title' => 'Users', // The title used in the navigation sidebar
//			'plural'    => 'Users', // The plural form of the model
//			'singular'  => 'User',  // The singular form of the model
//			'nav-icon'  => 'fa-user',  // The singular form of the model
//
//			// Fields used for model data
//			'fields'    => [
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
//					'name'        => 'name',
//					'label'       => 'User Name',
//					'placeholder' => 'Somebody Smith',
//					'default'     => '',
//					'rules'       => 'required',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
//					'name'        => 'email',
//					'label'       => 'Email Address',
//					'placeholder' => 'somebody@example.com',
//					'default'     => '',
//					'rules'       => 'required',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Password::class,
//					'name'        => 'password',
//					'label'       => 'Password',
//					'placeholder' => 'Enter password here...',
//					'default'     => '',
//					'rules'       => 'confirmed',
//					'searchable'  => false,
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Password::class,
//					'name'        => 'password_confirmation',
//					'label'       => 'Confirm Password',
//					'placeholder' => 'Repeat password here...',
//					'default'     => '',
//					'rules'       => '',
//					'searchable'  => false,
//				],
//			],
//
//			// Define what columns should appear on the model index. field=>label pairs
//			'index'     => [
//				'id'    => 'ID',
//				'name'  => 'Name',
//				'email' => 'Email Address',
//			],
//
//			// Define the default sort order for the model index.
//			'sort'      => [
//				'key' => 'name',    // Sort field name
//				'dir' => 'asc',     // Sort field direction
//			],
//		],  // End of User definition

	],

];
