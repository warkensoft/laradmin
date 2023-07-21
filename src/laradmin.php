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
//			'nav_icon'  => 'fa-users',  // The font-awesome icon for admin nav elements
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
//
//		// Sample entry for a post record.
//		'\\App\\Models\\Post' => [
//			'path'      => 'posts', // The path to the model under /laradmin/
//			'route'     => 'posts', // The route name used for the model
//			'nav_title' => 'Posts', // The title used in the navigation sidebar
//			'plural'    => 'Posts', // The plural form of the model
//			'singular'  => 'Post',  // The singular form of the model
//			'nav_icon'  => 'fa-file',  // The font-awesome icon for admin nav elements
//
//			// Fields used for model data
//			'fields'    => [
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
//					'name'        => 'title',
//					'label'       => 'Title',
//					'placeholder' => 'Something Amazing',
//					'default'     => '',
//					'rules'       => 'required',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
//					'name'        => 'slug',
//					'label'       => 'Slug',
//					'placeholder' => 'your-post-slug',
//					'default'     => '',
//					'rules'       => 'required',
//					'help'         => 'Leave blank to auto-generate the slug.',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Summernote::class,
//					'name'        => 'content',
//					'label'       => 'Content',
//					'placeholder' => 'Start writing here...',
//					'default'     => '',
//					'rules'       => '',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Textarea::class,
//					'name'        => 'teaser',
//					'label'       => 'Teaser',
//					'placeholder' => 'Just a short bit of text...',
//					'default'     => '',
//					'rules'       => '',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\ImageUpload::class,
//					'name'        => 'feature_image',
//					'label'       => 'Feature Image',
//					'placeholder' => '',
//					'default'     => '',
//					'rules'       => '',
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\SelectManyFromMany::class,
//					'name'       => 'tags',
//					'label'       => 'Tags',
//					'placeholder' => '',
//					'default'     => '',
//					'rules'       => '',
//					'relation'    => [
//						'type'   => 'many-to-many',
//						'model'  => \App\Models\Tag::class,
//						'method' => 'tags',
//						'key'    => 'id',
//						'label'  => 'title',
//					]
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\Select::class,
//					'name'        => 'status',
//					'label'       => 'Status',
//					'default'     => 'draft',
//					'rules'       => 'required',
//					'options'     => [
//				        'draft' => 'Draft',
//				        'private' => 'Private',
//				        'published' => 'Published',
//				    ],
//				],
//				[
//					'type'        => \Warkensoft\Laradmin\Fields\DateTime::class,
//					'name'        => 'published_at',
//					'label'       => 'Published At',
//					'placeholder' => '',
//					'default'     => '',
//					'rules'       => '',
//				],
//			],
//
//			// Define what columns should appear on the model index. field=>label pairs
//			'index'     => [
//				'title'  => 'Title',
//				'slug'  => 'Slug',
//				'status' => 'Status',
//			],
//
//			// Define the default sort order for the model index.
//			'sort'      => [
//				'key' => 'published_at',    // Sort field name
//				'dir' => 'desc',     // Sort field direction
//			],
//		],  // End of Post definition

	],

];
