# Laradmin Field Types & Configuration

The following field types are available to you for use in your configuration file.

- [\Warkensoft\Laradmin\Fields\Input::class](field-types.md#input-field)
- [\Warkensoft\Laradmin\Fields\Password::class](field-types.md#password-field)
- [\Warkensoft\Laradmin\Fields\Textarea::class](field-types.md#textarea-field)
- [\Warkensoft\Laradmin\Fields\Select::class](field-types.md#select-field)
- [\Warkensoft\Laradmin\Fields\Checkbox::class](field-types.md#checkbox-field)
- [\Warkensoft\Laradmin\Fields\DateTime::class](field-types.md#datetime-field)
- [\Warkensoft\Laradmin\Fields\Summernote::class](field-types.md#summernote-field)
- [\Warkensoft\Laradmin\Fields\ImageUpload::class](field-types.md#imageupload-field)
- [\Warkensoft\Laradmin\Fields\SelectFromMany::class](field-types.md#selectfrommany-field)
- [\Warkensoft\Laradmin\Fields\SelectManyFromMany::class](field-types.md#selectmanyfrommany-field)


## Input Field

	'type'        => \Warkensoft\Laradmin\Fields\Input::class,
	'name'        => 'title',
	'label'       => 'Sample Title',
	'placeholder' => 'Some Fantastic Title',
	'default'     => '',
	'rules'       => 'required',
	'searchable'  => true,

The input field is your most simple HTML input box, with a label, input box and placeholder. It supports all the 
parameters listed above, most of which are common to the other field types as well.

#### `name`

Provide a string with the name of the field. This should normally match the field name on the model and in the database.

#### `label`

This will be used as the label for the field on the form.

#### `placeholder`

This will be used as the HTML placeholder for the field on the form.

#### `default`

This will be used as the default value for the field on the form.

#### `rules`

The rules for how the field is to be validated. Follows standard Laravel validation terms as described here:
https://laravel.com/docs/5.7/validation#available-validation-rules

#### `searchable`

Optional field. Set to `false` to prevent Laradmin from searching the values in this field.


## Password Field

	'type'        => \Warkensoft\Laradmin\Fields\Password::class,
	'name'        => 'password',
	'label'       => 'Password',
	'placeholder' => 'Enter password here...',
	'rules'       => 'confirmed',
	'searchable'  => false,
	
The password field is only slightly different from the input field and accepts almost all the same configuration 
parameters. The important differences are:

- It is a password field, so input is hidden.
- There is no `value` or `default` displayed on the field. 


## Textarea Field

	'type'        => \Warkensoft\Laradmin\Fields\Textarea::class,
	'name'        => 'body',
	'label'       => 'Content',
	'placeholder' => 'Write something amazing!',
	'default'     => '',
	'rules'       => '',
	'rows'        => 10,

The textarea field presents the user with a textarea box where they may type multiple paragraphs of text. In addition to 
the regular input box fields, it supports a `rows` field. 

#### `rows`

Optionally define how many rows the textarea will display. Default: 6


## Select Field

	'type'        => \Warkensoft\Laradmin\Fields\Select::class,
	'name'        => 'some_choice',
	'label'       => 'Choice Title',
	'default'     => '',
	'rules'       => '',
	'options'     => [
		'a' => 'Item A',
		'b' => 'Item B',
		'c' => 'Item C',
	],

The select field presents the user with a select dropdown where they may choose a single item. In addition to 
the regular input box fields, it supports an `options` field.

#### `options`

Define an array of key/value pairs to be used as the selection options. 


## Checkbox Field

	'type'        => \Warkensoft\Laradmin\Fields\Checkbox::class,
	'name'        => 'published',
	'label'       => 'Published',
	'placeholder' => '',
	'default'     => '1',           // Defines the default value assigned when the checkbox is saved.
	'rules'       => 'boolean',

The checkbox field presents a checkbox to the user. The label is shown to the right of the box. It's submitted
value is defined by the `default` field.


## DateTime Field

	'type'        => \Warkensoft\Laradmin\Fields\DateTime::class,
	'name'        => 'published_at',
	'label'       => 'Publish Date',
	'placeholder' => '',
	'default'     => '',
	'rules'       => 'required',
	'format'      => 'F j, Y',

The datetime field displays a standard input box, however when clicked it presents the user with a date and time 
picker box based on the [DateTimePicker jQuery plugin](https://xdsoft.net/jqplugins/datetimepicker/).

This field type requires a DateTime field in your database.

#### `format`

Used to define the presentation format of the DateTime field when displayed on Laradmin index pages.


## Summernote Field

	'type'        => \Warkensoft\Laradmin\Fields\Summernote::class,
	'name'        => 'body',
	'label'       => 'Content',
	'placeholder' => 'Write something amazing!',
	'default'     => '',
	'rules'       => 'required',
	
The summernote field accepts the same parameters as the regular [textarea field](field-types.md#textarea-field). 
It presents the user with a WYSIWYG input area where text may be entered and formatted by using the excellent 
[Summernote](https://summernote.org/) library.


## ImageUpload Field

	'type'        => \Warkensoft\Laradmin\Fields\ImageUpload::class,
	'name'        => 'feature_image',
	'label'       => 'Feature Image',
	'placeholder' => '',
	'default'     => '',
	'rules'       => '',
	'path'        => 'public',
	'uri'         => '/storage',
	
The ImageUpload field presents the user with a file upload field which can be used to upload images related to the model.
The field on the model should be a `string` since it will hold the URL to the file once uploaded. In addition to normal 
input parameters, several other configuration parameters may be used.

#### `path`

Define the path relative to the storage/app folder where the images will be placed. In the example above, using 
`public` as the path will result in the uploads being placed in /storage/app/public, assuming standard Laravel paths
are being used.

#### `uri`

Define the relative path to the image when viewed on the website. In the sample parameters above, the images will be 
uploaded to `/storage/app/public/something.jpg`, but when viewed on the website will be accessible at 
`/storage/something.jpg`.

**IMPORTANT!!** In order for this to work you must create a symlink from the public folder to your storage folder using the
Laravel artisan command `php artisan storage:link`. This will create a symbolic link from `public/storage` to 
`storage/app/public`


## SelectFromMany Field

	'type'        => \Warkensoft\Laradmin\Fields\SelectFromMany::class,
	'name'       => 'author_id',
	'label'       => 'Author ID',
	'placeholder' => '',
	'default'     => '',
	'rules'       => 'integer',
	'relation'    => [
		'type'   => 'one-to-many',
		'model'  => \App\User::class,
		'method' => 'author',
		'key'    => 'id',
		'label'  => 'name',
	]

This field presents the user with a selection dropdown containing a list of related models. A field set up with the 
example parameters above would work well on a `Page` model to display a list of users to choose an author.

The type of field used on the model should match the primary key of the related model. The model class should also be set
up with a `belongsTo()` relationship pointed to the related model.

For example, if using the parameters above in a `Page` class, one would need to have an `UNSIGNED INT author_id` field
in the database and a method like the following on the model:

	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
    }

#### Relation Fields

#### `type`

Defines what type of relationship is used. Type should be set to:

- one-to-many

#### `model`

The related model class name.

#### `method`

The name of the method in the current class which describes the `belongsTo()` relationship. 

#### `key`

The primary key of the related model. This will corrospond to the field name on the current model. 

#### `label`

The name of the field used in displaying the data from this relationship on indexes. For the example above, the `Pages`
index will display the `$user->name` field in a column related to each page.


## SelectManyFromMany Field

	'type'        => \Warkensoft\Laradmin\Fields\SelectManyFromMany::class,
	'name'       => 'tags',
	'label'       => 'Tags',
	'placeholder' => '',
	'default'     => '',
	'rules'       => '',
	'relation'    => [
		'type'   => 'many-to-many',
		'model'  => \App\Tag::class,
		'method' => 'tags',
		'key'    => 'id',
		'label'  => 'name',
	]
	
This field presents the user with a multi-line select box allowing for the management of many-to-many relationships
between models. The fields are essentially the same as `SelectFromMany`. The `[relation][method]` value should match
the method name on the model that is used to define the Many to Many relationship. For the example above, you would
need the following method in your model.

	public function tags() {
		return $this->belongsToMany(Tag::class);
    }


#### `type`

Defines what type of relationship is used. Type should be set to:

- many-to-many
