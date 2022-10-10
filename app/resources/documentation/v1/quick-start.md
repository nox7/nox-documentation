# Quick Start to Setting up Your Nox Project
Nox is a do-less framework for Apache server PHP projects that leaves many implementations up to you. The only goal of Nox is to be an MVC foundation with no 3rd party dependencies outside of native PHP extensions.

<div class="alert alert-warning">
	Nox is only tested and officially supported by PHP projects on <strong>Apache servers</strong> (such as common web hosts through a cPanel interface or standalone installs). Nginx and standalone CLI has not been tested and is assumed to not work out of the box.
</div>

## Installing
Nox should be installed using [composer](https://getcomposer.org/download/) (For Windows, make sure to download the Windows installer and don't do it via command-line). We do not officially support manual installations of Nox (source files can be found on GitHub).

```bash
composer require nox7/nox
```

Once installed, from your project root directory create a work folder for your web project to live in. Nox standard practice is to just call this folder `app`. Then change directory into that folder.

```bash
mkdir app
cd app
```

Finally, setup the base skeleton project using the command below. You must have `php` available in your command line or PATH variable (for Windows machines).

```php
php ../vendor/nox7/nox/src/Scripts/make-sample-project.php
```

Your working directory will look equivalent to the one shown below.

![Nox directory example](https://i.imgur.com/6dSrWuo.png)

<div class="alert alert-primary">
    <strong>Note:</strong> Typically, you will never want to commit your <strong>nox-env.php</strong> file and will want to add that file to your repository's .gitignore file.
</div>

## Your Apache Document Root
When setting up your virtual host in Apache, you should set your serving directory (the DocumentRoot directory in Apache configuration files) to your `app` directory. **Make every attempt to not** serve your project from the project root (the parent of the `app` folder).

## Serving Your Nox Project from the Project Root
In the cases where you don't have much control over changing your apache DocumentRoot (such as a shared host in cPanel), or where it may be too much of a hassle; you can easily migrate the Apache config (`.htaccess`) file in the Nox framework to the root with a small change.

The **original** Apache config (`.htaccess`) file is shown below.

```apacheconf
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/nox-request.php
RewriteRule .* /nox-request.php [L,QSA]
```

To change this file to work from your project root **instead of your /app directory**, then move the `.htaccess` file to the project root directory (parent folder of your /app directory) and change the source to reflect this (shown below).

```apacheconf
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/app/nox-request.php
RewriteRule .* /app/nox-request.php [L,QSA]
```

Your project will now serve your app without having to change your VirtualHost's DocumentRoot directive to the `app` folder.