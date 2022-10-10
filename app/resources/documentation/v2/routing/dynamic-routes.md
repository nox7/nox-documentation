# Dynamic Routing - Runtime Routes Without Using Attributes
Not all projects can be satisfied with attribute routing. For example, should you want to create a content management system (CMS) that allows users to define page routes then you would need the Nox *dynamic routes*.

## What is a Dynamic Route?
In contrast to an attribute route, a dynamic route is route that can be added after the PHP syntax has been pre-processed by the interpreter. That is, a runtime-defined route. You can create DynamicRoute objects and register them into the router. This **should always be done** somewhere in the `nox-request.php` file before the `$nox->processRoutableRequest()` call is made.

Why would you want to do this? Say you have a database table that has pages with a column for <code class="language-php">page_route</code>. You would want to iterate through all of your pages and register that route into the Nox router.

## The DynamicRoute Object
Dynamic routes are represented by the DynamicRoute object. Construction of one is shown below.

The DynamicRoute object has the following construction signature.
```php
class DynamicRoute{
    public function __construct(
        public string $requestMethod,
        public string $requestPath,
        public bool $isRegex,
        public Closure $onRender,
        public ?Closure $onRouteCheck = null,
    );
}
```

The parameters `requestMethod`, `requestPath`, and `isRegex` should be familiar from the standard `#[Route]` attribute. They also come in the same order. However, unlike the Route attribute, onRender and onRouteCheck exist.

Only `onRender` is required to be defined. `onRender` is called when the DynamicRoute is matched. The function you provide to `onRender` is expected to return a string, an instance of `Rewrite` or an instance of `Redirect`. No other returns should be used.

`onRouteCheck`, if provided, will be run before `onRender` to determine if this DynamicRoute is usable. 

### Providing onRouteCheck
When constructing a DynamicRoute and choosing to provide the onRouteCheck, it is expected to **always** return an instance of `DynamicRouteResponse`. The anatomy of this class is below.
```php
class DynamicRouteResponse{
    public function __construct(
        public bool $isRouteUsable,
        public ?int $responseCode = null,
        public ?string $newRequestPath = null
    );
}
```

Similar to `AttributeRouteResponse` used in the [attribute routing](/docs/2.0/routing/custom-route-method-attribute), this object will tell the Nox router if this DynamicRoute is usable.

An example of constructing a DynamicRoute with `onRouteCheck` provided is below.

```php
use Nox\Router\DynamicRoute;
use Nox\Router\DynamicRouteResponse;

$dynamicRoute = new DynamicRoute(
    requestMethod: "get",
    requestPath:"/",
    isRegex:false,
    onRender:Closure::fromCallable(function(){
        return "<p>Hello world!</p>";
    }),
    onRouteCheck:Closure::fromCallable(function(){
        return new DynamicRouteResponse(
            isRouteUsable: true,
        );
    }) 
);
```

We can tell the router that this route is **never** usable by passing false as `isRouteUsable`. The router will simply *skip over* this dynamic route. If we want routing to **stop** and return an HTTP status code then we can provide one or both of the other constructor parameters.

```php
use Nox\Router\DynamicRoute;
use Nox\Router\DynamicRouteResponse;

$dynamicRoute = new DynamicRoute(
    requestMethod: "get",
    requestPath:"/",
    isRegex:false,
    onRender:Closure::fromCallable(function(){
        return "<p>Hello world!</p>";
    }),
    onRouteCheck:Closure::fromCallable(function(){
        return new DynamicRouteResponse(
            isRouteUsable: false,
            responseCode:403,  
            newRequestPath:"/403",
        );
    }) 
);
```

This will halt routing, set the HTTP status code as 403, and rewrite the request to the route of `/403`. You can omit the `newRequestPath` parameter if you just want to send an empty HTTP response body and a 403 status code.

## Registering Dynamic Routes into the Nox Router
To even be usable, the DynamicRoute object must be **registered** into the Nox router. This **must** be done before the `$nox->processRoutableRequest();` call in the `nox-request.php` file in your project.

Let's assume the variable (in the below example) `$dynamicRoute` is an instance of `DynamicRoute`. We can register it in the current instance of Nox (`$nox`) like so.

```php
$nox->router->addDynamicRoute($dynamicRoute);
```