# Routing with Attributes
Nox utilizes the PHP attributes introduced in PHP version 8 to route requests to the proper class and method.

The Nox configuration file will tell the framework which directory to parse MVC controllers in. By default, it is the `/controllers` directory of your project directory.

## Setting Up a Controller Class
Because your request handler (by default, the nox-request.php file in your project's directory) requires the autoload.php file, you do not need to require the Nox framework components in the controllers.


```php
<?php
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\Router\BaseController;

    #[Controller]
    class HomeController extends BaseController{

    }
```

All of your controller classes will extend the `BaseController`.

To add a method which will display content, use the `#[Route()]` attribute on any **public** method in your controller class.

```php
<?php
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\Router\BaseController;

    #[Controller]
    class HomeController extends BaseController{

        #[Route("GET", "/")]
        public function homeView(): string{
            header("content-type: text/html; charset=utf8");

            return "Home page";
        }

    }
```

The `homeView()` method is now routed to the home page. Visiting your home page will output "Home page".

The name of your public methods do not matter to Nox. You can name your classes and methods however you'd like as long as the class file is in your project's controllers directory they will be loaded. **Sub-folders are allowed in the controllers directory and are recursively parsed.**

Route **is a repeatable attribute**, and you can define multiple routes on a controller class method.

### Regular Expressions and Routes
You can use PHP's standard PCRE library in your routes. Additionally, named capture groups will be found in the `BaseController::$requestParameters` array. All Controllers must extend from BaseController, so this will always be accessible.

Below shows only a method (inside a controller class) with a route using the regular expression flag (third argument of `#[Route()]` to capture a forum post route.
```php
    #[Route("GET", "/\/forum\/post\/(?&lt;threadID&gt;\d+)/", true)]
    public function threadView(): string{
        header("content-type: text/html; charset=UTF-8");

        // Fetch the named capture group
        $params = BaseController::$requestParameters;
        $threadID = (int) $params['threadID'];

        return (string) $threadID;
    }
```

## Routes With a Common Base
In instances where many of your route methods have a common base, you can define the class-specific attribute `#[RouteBase()]` **on the class** the methods are a part of.

Adding this attribute to your controller class will force all the routes on the methods of the class to be prepended with the base defined in the route.

In the example below, all routes will only match if */api/v1* comes before them.

```php
<?php
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\Router\BaseController;

    #[Controller]
    #[RouteBase("/api/v1")]
    class HomeController extends BaseController{

        // This route will now only match /api/v1/ (or /api/v1)
        #[Route("GET", "/")]
        public function homeView(): string{
            header("content-type: text/html; charset=utf-8");

            return "Home page";
        }

    }
```

RouteBase **is a repeatable attribute**, and you can define multiple bases on a controller class.

### Route Bases With Regular Expressions
Similarly to method routes, you can define a `#[RouteBase()]` as a regular expression capture. The named capture groups will be found in the `BaseController::$requestParameters` array - just like method Routes with named regular expression capture groups.

```php
<?php
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\Router\BaseController;

    #[Controller]
    #[RouteBase("/\/api\/v1\/(?&lt;pageName&gt;[^\/])/", true)]
    class HomeController extends BaseController{

    // And so on...
    // pageName is accessible in the BaseController::$requestParameters index on any method.
```