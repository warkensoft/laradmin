# Full Install Example

The following is an example of a full installation starting with a brand new copy of Laravel. We will go through the 
process of creating a new Laravel site, installing the Laradmin package, and verifying that the interface allows 
logged-in users to access it.

**IMPORTANT WARNING!** As mentioned at the bottom of this document, out of the box Laradmin is very insecure, requiring
only a logged in user to access the interface. Further security customization via middleware is **highly recommended**. 

## On the commandline...

### `$ laravel new yoursite`

Install a new Laravel site using your preferred method. I enjoy using the `laravel new something` commandline.

### `$ cd yoursite`

Use the commandline to change directory into your new site's root folder.

### `$ composer require warkensoft/laradmin:1.*`

This will pull the Laradmin interface as a package into your new Laravel installation.

### `$ php artisan vendor:publish --provider="Warkensoft\Laradmin\Provider" --tag=config`

This will publish a sample laradmin.php file to your /config/ folder in the new site. You will use this file to 
configure Laradmin for your website's needs.

### `$ php artisan breeze:install`

This creates Laravel's built-in user authentication scaffolding in order to allow users to register and log in.

### `$ npm install && npm run dev`

This npm commands create build assets

## Create a new MySQL database

Use your favourite tool to create a new MySQL database to store the site data in. Set up a new database user and 
password to have access to the new database.

## Configure your `.env` file

Adjust the database settings in your `.env` file to point to the new database with the username and password that you
created in the previous step.

##  Back to commandline...

### `$ php artisan migrate`

If all has gone as planned, this will create the basic Laravel authentication tables needed for people to register and
log in. 

## Check The Site

At this point in the installation process, you should be able to view the site. If you are using the excellent 
Laravel Valet, you should simply be able to point your browser to `http://yoursite.test` (depending on your Valet 
configuration) and see the site with the default Laravel landing page.

You should also see links in the upper-right to Log in and Register. You should be able to click the "Register" button, 
enter your details, and actually register as a user on the site.

## Log in to Laradmin

Now that you have logged in to your new site, you should be able to access the Laradmin interface. To do that, modify the 
URL in your browser to the location defined in the `adminpath` parameter in the laradmin.php configuration file. If you 
haven't modified it, you should be able to see it at `http://yoursite.test/laradmin/`

**WARNING** Right now, this makes your site VERY insecure, and more configuration should be made in order to prevent
just any registered and logged in user from having full access to modify the site.