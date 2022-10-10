# The URL Request Handler
The Apache config file (.htaccess) routes **all requests** (including static file requests) to the `nox-request.php` file. Nox handles every request on a web project.

This file, however, is meant to allow you to customize. A skeleton is provided in the example Nox project to help set up a working Nox application for you, but you are free to modify this file to suit your needs.

All configurations are loaded in this file and all controllers, views, layouts, etc. will be a child scope of this file due to this being the location all requests are processed.

A default `nox-request.php` file is shown below.

```php
<?php
    use Nox\ORM\Abyss;

    require_once __DIR__ . "/../vendor/autoload.php";
    require_once __DIR__ . "/nox-env.php";

    $requestPath = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Load the router
    $router = new Nox\Router\Router(
        requestPath:$requestPath,
        requestMethod:$requestMethod,
    );
    $router->loadAll(
        fromDirectory: __DIR__,
    );

    // Load the Abyss ORM configuration
    // Comment this out to disable using Abyss and require a MySQL connection
    Abyss::loadConfig(__DIR__);

    // Load the request handler
    $requestHandler = new \Nox\Router\RequestHandler($router);
    \Nox\Router\BaseController::$requestHandler = $requestHandler;

    // Process the request
    $requestHandler->processRequest();
```