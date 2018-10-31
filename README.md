# Laradmin

A simple, powerful, drop-in administrative interface for Laravel.

This project came about from a desire to have a simple administrative interface that could be dropped into a new or existing Laravel based site to manage any/all editable content.

- [Installation](https://github.com/warkensoft/laradmin/#installation)
- [Configuration Options](https://github.com/warkensoft/laradmin/#configuration-options)
- [Field Configuration](https://github.com/warkensoft/laradmin/#field-configuration)
- [Project Objectives & Goals](https://github.com/warkensoft/laradmin/#project-objectives--goals)
- [Architecture Ideas](https://github.com/warkensoft/laradmin/#architecture-ideas)


## Installation

With composer, simply run the following on the commandline:

```
$ composer require warkensoft/laradmin
$ php artisan vendor:publish --provider="Warkensoft\Laradmin\Provider" --tag=config
```

This will install the package on your laravel application and publish a `laradmin.php` config file to your configuration 
folder. You will use this file to configure how Laradmin will run on the application.

All the views used by the interface can be overridden as needed. To publish all customizable assets, use
```
$ php artisan vendor:publish --provider="Warkensoft\Laradmin\Provider"
```


## Configuration Options

The following options are able to be customized in the laradmin.php configuration file.

#### middleware

Defines what middleware is required in order to see the Laradmin interface. Out of the box, it simply requires a 
logged-in user.

    'middleware' => [ 'auth' ]

#### adminpath

The base path for the Laradmin area. For example, the default would allow you to access the Laradmin interface at:
https://yourdomain.com/laradmin/dashboard

    'adminpath'  => 'laradmin',

#### layout

The base template used to display the Laradmin interface. You may replace this with your own if needed, however it would
likely be better to use the view overrides instead by publishing the views and modifying them as needed.

    'layout'       => 'laradmin::layouts.admin',

#### index-length

Allows you to define how many entries are listed per page on model indexes.

    'index-length' => 10,

#### crudable

Here is where you define what models will be editable in the Laradmin interface. The following example defines the
\App\User model to be editable in Laradmin, what the path and routes will be, and the fields that will be displayed
in order to edit the records. See Field Configuration for more details on the fields themselves.

	'crudable'     => [

		// Sample entry for a standard laravel user record.
		'\\App\\User' => [
			'path'      => 'users', // The path to the model under /laradmin/
			'route'     => 'users', // The route name used for the model
			'nav_title' => 'Users', // The title used in the navigation sidebar
			'plural'    => 'Users', // The plural form of the model
			'singular'  => 'User',  // The singular form of the model

			// Fields used for model data
			'fields'    => [
				[
					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
					'name'        => 'name',
					'label'       => 'User Name',
					'placeholder' => 'Somebody Smith',
					'default'     => '',
					'rules'       => 'required',
				],
				[
					'type'        => \Warkensoft\Laradmin\Fields\Input::class,
					'name'        => 'email',
					'label'       => 'Email Address',
					'placeholder' => 'somebody@example.com',
					'default'     => '',
					'rules'       => 'required',
				],
				[
					'type'        => \Warkensoft\Laradmin\Fields\Password::class,
					'name'        => 'password',
					'label'       => 'Password',
					'placeholder' => 'Enter password here...',
					'default'     => '',
					'rules'       => 'confirmed',
					'searchable'  => false,
				],
				[
					'type'        => \Warkensoft\Laradmin\Fields\Password::class,
					'name'        => 'password_confirmation',
					'label'       => 'Confirm Password',
					'placeholder' => 'Repeat password here...',
					'default'     => '',
					'rules'       => '',
					'searchable'  => false,
				],
			],

			// Define what columns should appear on the model index. field=>label pairs
			'index'     => [
				'id'    => 'ID',
				'name'  => 'Name',
				'email' => 'Email Address',
			],

			// Define the default sort order for the model index.
			'sort'      => [
				'key' => 'name',    // Sort field name
				'dir' => 'asc',     // Sort field direction
			],
		],  // End of User definition

	],


## Field Configuration

Each field that you want to allow to be modified by Laradmin must be defined as a field declaration in the fields array.
These generally follow a pattern such as the following:

	'type'        => \Warkensoft\Laradmin\Fields\Input::class,
	'name'        => 'name',
	'label'       => 'User Name',
	'placeholder' => 'Somebody Smith',
	'default'     => '',
	'rules'       => 'required',

#### Field `type`

The `type` variable defines a Field class in the Laradmin interface. The following classes currently exist.

- `\Warkensoft\Laradmin\Fields\Input::class`
- `\Warkensoft\Laradmin\Fields\Password::class`
- `\Warkensoft\Laradmin\Fields\Textarea::class`

You may define additional classes in your own application as needed, so long as they conform to the `FieldContract` 
interface. In this way you can extend the Laradmin platform with any additional types of fields you might need.

The purpose of the `Field` classes is two-fold. First, they should define the view to be used in displaying the field.
This is done through a simple `view()` method on the class which returns a string with the view name.

Second, they have the ability to filter and modify the submitted model data before it is saved, in order to make any 
necessary changes. 

#### Field `name`

Provide a string with the name of the field. This should normally match the field name on the model and in the database.

#### Field `label`

This will be used as the label for the field on the form.

#### Field `placeholder`

This will be used as the HTML placeholder for the field on the form.

#### Field `default`

This will be used as the default value for the field on the form.

#### Field `rules`

The rules for how the field is to be validated. Follows standard Laravel validation terms as described here:
https://laravel.com/docs/5.7/validation#available-validation-rules

#### Field `searchable`

Set to `false` to prevent Laradmin from searching the values in this field.

#### Additional Fields

Other fields can be declared in the array, and will be passed through for use in the view. For example, the `Textarea`
field type also supports a `rows` parameter which is used (when given) to define how many rows are shown in the textarea.


## Project Objectives & Goals

- Works with standard Laravel user authentication.
- Drops in as a simple dependency via composer.
- Fully overriddable by custom scripting in order to extend as needed.
- Clean & simple interface.
- Extensible to support any type of content data.
- Support common model relationships.
- Community driven.


## Architecture Ideas

- Entirely controlled through a config file.
- Config file defines list of models to support admin CRUD.
- Model config describes: 
  - validation rules
  - text labels (plural, singular, ...)
  - controller classname (if overridden)
  - route name
  - path
  - displayed index fields (for use in the view)
- Config file defines each field on each model as to the following:
  - Label
  - Name
  - Type (input, textarea, checkbox, radio, select, image upload, relationship, tags list, ...)
  - Placeholder
  - Default value
  - Relationship details (if any)
- Field types are tied directly to view partials.
