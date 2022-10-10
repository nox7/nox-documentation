# Routing with Attributes
Nox utilizes the PHP attributes introduced in PHP 8 to route requests to the proper class and method - otherwise known in MVC terminology as controllers.

The Nox configuration file will tell the framework which directory to parse MVC controllers in. Classes marked with the `#[Controller]` attribute will be loaded into the Nox cache of available classes to check for public methods in.

## Setting Up a Controller Class
```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;

#[Controller]
class HomeController extends BaseController{

}
```

This is the bare-bones outline for a class that will be registered into the Nox controllers cache. The Nox framework will use reflections to read all public methods in this class and will attempt to route requests against any method with a matching `#[Route()]` attribute on that method.

```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;

#[Controller]
class HomeController extends BaseController{

    #[Route("GET", "/")]
    public function homeView(): string{
        header("content-type: text/html; charset=utf8");

        return "<p>Home page</p>";
    }

}
```

If you now visit the home page of your website, the text `Home page` will be outputted.

The names of your public methods do not matter to Nox. You can name your classes and methods however you'd like.

`#[Route]` *is a repeatable* attribute. You can define multiple routes on a method.

## Regular Expressions and Routes
You can use PHP's standard PCRE library in your routes. Additionally, named capture groups will be found in the`BaseController::$requestParameters` array. All Controllers must extend from BaseController, so this will always be accessible.

Below shows only a method (inside a controller class) with a route using the regular expression flag (third argument of `#[Route()]`) to capture a forum post route.

```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;

#[Controller]
class HomeController extends BaseController{

    #[Route("GET", "/\/forum\/thread\/(?<threadID>\d+)/", true)]
    public function threadView(): string{
        header("content-type: text/html; charset=UTF-8");
    
        // Fetch the named capture group
        $params = BaseController::$requestParameters;
        $threadID = (int) $params['threadID'];
    
        return "The forum thread ID is $threadID";
    }
    
}
```

## Routes With a Common Base
In instances where many of your route methods have a common base, you can define the class-specific attribute `#[RouteBase()]` on the class the methods are a part of.

Adding this attribute to your controller class will force all the routes on the methods of the class to be prepended with the base defined in the route.

In the example below, all routes will only match if <em>/api/v1</em> comes before them.

```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;

#[Controller]
#[RouteBase("/api/v1")]
class HomeController extends BaseController{

    #[Route("GET", "/")]
    public function homeView(): string{
        header("content-type: text/html; charset=utf-8");

        return "This is the index/home view of /api/v1";
    }

}
```

Regardless of whether the URI is `/api/v1/` or `/api/v1` (no trailing slash) the `/` route will match either. For regular expression purposes, the Nox framework will always make sure that a `/` is at the start of a URI - so your regular expressions, should they be strict, should expect `/` to start the string the route will match against. 

**You can define a RouteBase as a regular expression** string by setting the second argument of the `RouteBase` constructor to true.

Named capture parameters are added as key-value pairs into `BaseController::$requestParameters`.

RouteBase is a repeatable attribute. You can define multiple bases on a controller class.