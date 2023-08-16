# Upgrade Guide

## From 2.1.0 to 2.2.0

In this version the dependency on Bootstrap CSS has been removed in favour
of Tailwindcss. The dashboard has also been given an overhaul and now supports
optional widgets for various models. Configuration of these is done in the 
laradmin config file.

### Upgrade Instructions

1. Upgrade Laradmin to v2.2 `composer require warkensoft/laradmin:^2.2.0`
2. Remove old vendor files from `PROJECT_ROOT/public/vendor/laradmin`
3. Re-run install command:
   `php artisan vendor:publish --provider="Warkensoft\Laradmin\Provider" --tag=public`
4. If you have custom views in ROOT/resources/views/vendor/laradmin you may need to
   make some modifications to align with the new CSS. Compare your custom model editing
   views with the files in `vendor/warkensoft/laradmin/src/Resources/Views/crudable/`.

## From 1.x to 2.x

Laradmin 2.0 cleans up, combines and minifies several of the external 
packages previously included with the SB Admin template. Package 
management is now handled with `npm` and files are bundled using `parcel`.

### Upgrade Instructions

1. Upgrade Laradmin to v2. `composer require warkensoft/laradmin:^2.1.0` 
2. Remove old vendor files from `PROJECT_ROOT/public/vendor/laradmin`
3. Re-run install command: 
    `php artisan vendor:publish --provider="Warkensoft\Laradmin\Provider" --tag=public`

### Bundled Packages:

- jQuery
- bootstrap
- fontawesome (free)
- jQuery - easing
- jQuery - datetimepicker
- select2
- summernote

 