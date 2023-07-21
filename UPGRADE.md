# Upgrade Guide

## From 1.x to 2.x

Laradmin 2.0 cleans up, combines and minifies several of the external 
packages previously included with the SB Admin template. Package 
management is now handled with `npm` and files are bundled using `parcel`.

### Upgrade Instructions

1. Upgrade Laradmin to v2. `composer require warkensoft/laradmin:^2.0` 
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

 