# Laradmin Field Types & Configuration

The following field types are available to you for use in your configuration file.

- [\Warkensoft\Laradmin\Fields\Input::class](field-types.md#input-field)
- [\Warkensoft\Laradmin\Fields\Password::class](field-types.md#password-field)
- [\Warkensoft\Laradmin\Fields\Textarea::class](field-types.md#textarea-field)
- [\Warkensoft\Laradmin\Fields\SelectFromMany::class](field-types.md#select-from-many-related-field)
- [\Warkensoft\Laradmin\Fields\ImageUpload::class](field-types.md#imageupload-field)
- [\Warkensoft\Laradmin\Fields\Summernote::class](field-types.md#summernote-field)

## Input Field

The input field is your most simple HTML input box, with a label, input box and placeholder. It supports all the 
following parameters, most of which are also common to the other field types as well.


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

Set to `false` to prevent Laradmin from searching the values in this field.

#### Additional Parameters

Other fields can be declared in the array, and will be passed through for use in the view. For example, the `Textarea`
field type also supports a `rows` parameter which is used (when given) to define how many rows are shown in the textarea.
 