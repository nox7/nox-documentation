# Installing Nox and Starting Your Project
Nox is a do-less framework for Apache server PHP projects that leaves many implementations up to you. Nox aims to leave 3rd-party dependencies out of its core and up to the developer to install at-will.

Nox is tested primarily for Apache web servers. Nginx is not officially supported but theoretically should work out-of-the-box as long as all HTTP requests get rewritten (not redirected) to the nox-request.php file. The goal of Nox was to be a lightweight MVC framework to be deployed to the common user's web server that is managed by cPanel/WHM or self-hosted.

## Installing
Nox should be installed using [composer](https://getcomposer.org/download/) (For Windows, make sure to download the Windows installer and don't do it via command-line). Manual installations are at your own risk and liability. You can find the source files for [Nox on GitHub](https://github.com/nox7/nox).

In the folder you want to begin your website or application, open a terminal and enter the following composer installation command.

```
composer require nox7/nox
```

Once installed, from your project root directory create a work folder for your web project to live in. Standard practice in Nox is to just name the directory for your website or application as <code>app</code>. As this directory will contain a <code>src</code> and <code>resources</code> folder later. However, you can name the top-level project (the <code>app</code> folder) whatever you'd like. For this tutorial, we will just be using "app"

In a terminal where you installed Nox, run these two commands one after the other.

```
mkdir app
```
```
cd app
```

Finally, set up the base skeleton project using the command below. You must have <code>php</code> available in your command line or PATH variable (for Windows machines).

```
php ../vendor/nox7/nox/src/Scripts/make-sample-project.php
```

Your working directory will look equivalent to the one shown below.

![Working Nox directory](/images/v2/nox-file-system-example.png)

## Your Apache Document Root
When setting up your virtual host in Apache, you should set the DocumentRoot to your <code>app</code> directory. <strong>Make every attempt to not</strong> serve your project from the project root (the parent of the <code>app</code> folder).

### Serving Your Nox Project from the Project Root
In the cases where you don't have a choice and the web server is serving the application or website from the project root (instead of the app directory) like in a cPanel/WHM configuration, then you can easily migrate the Apache config (<code>.htaccess</code>) file in the Nox framework to the root with a small change.

The <strong>original</strong> Apache config (<code>.htaccess</code>) file is shown below.

```
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/nox-request.php
RewriteRule .* /nox-request.php [L,QSA]
```

Move the .htaccess file to the root directory of the project (parent of the app folder) and then change the htaccess source to what is shown below.

```
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/app/nox-request.php
RewriteRule .* /app/nox-request.php [L,QSA]
```

Your project will now serve your app without having to change your VirtualHost's DocumentRoot directive to the <code>app</code> folder.