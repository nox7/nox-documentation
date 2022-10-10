# Dynamic Routing - Routing Without Attributes
Not all projects can be satisfied with PHP8+ attribute routing. For example, should you want to create a content management system (CMS) or similar application which allows userland routing, you will require **dynamic routes**.

## What is a dynamic route?
In contrast to an attribute route, a dynamic route is route that can be added after the PHP syntax has been pre-processed by the interpreter. You can create DynamicRoute objects and register them into the router.

Why would you want to do this? Say you have a database table that has pages with a column for `page_route`. You would want to iterate through all of your pages and register that route into the Nox router.

## The DynamicRoute Object
Dynamic routes are represented by the DynamicRoute object. Construction of one is shown below.
```php
new Nox\Router\DynamicRoute(
    requestMethod: "get",
    requestPath: "/test",
    isRegex: false,
    onRender: Closure::fromCallable(function() {
        return "<p>Hello world</p>"
    }),
);
```

You'll notice that there is an `onRender` parameter in the constructor. This is a `Closure` that holds an anonymous function to be called if the route is matched and needs to be rendered. This closure is called as a method of the `BaseController` and as such has access to any properties or methods of that class.

The return of the onRender closure callable should be a string or other Nox-router understand result (such as a Rewrite or Redirect) - just as it is with the attribute route methods.

## Pre-flight checks on a Route Before Rendering
Similar to how attribute routes can affect whether they will be processed when the route is matched, dynamic routes have this ability too. Optionally, you can provide the `onRouteCheck` parameter to the DynamicRoute constructor parameters. This function is called **if the route is matched**. You can perform logic in this function to determine if the route can be usable. This Closure's callable **must return** a DynamicRouteResponse object.

```php
// This DynamicRoute will _never_ match
// But it will not stop the router from checking other routes
new Nox\Router\DynamicRoute(
    requestMethod: "get"
    requestPath: "/always-404",
    isRegex: false,
    onRender: Closure::fromCallable(function() {
        return "<p>You will never see me</p>";
    }),
    onRouteCheck: Closure::fromCallable(function() {
        return new Nox\Router\DynamicRouteResponse(
            isRouteUsable: false,
        );
    }),
);
```

A situation that this could be used in would be to check if the current HTTP session has an authenticated user. You can choose to just provide `isRouteUsable` in the DynamicRouteResponse object constructor, or provide the other two parameters (responseCode, or newRequestPath) to **stop the router from checking other routes** and rewrite the request here.

```php
// This DynamicRoute will _never_ match
// And it will cause the router to stop here instead
// of continuing to search for other routes
new Nox\Router\DynamicRoute(
    requestMethod: "get",
    requestPath: "/always-404",
    isRegex: false,
    onRender: Closure::fromCallable(function() {
        return "<p>You will never see me</p>";
    }),
    onRouteCheck: Closure::fromCallable(function() {
        return new Nox\Router\DynamicRouteResponse(
            isRouteUsable: false,
            responseCode:404,
        );
    }),
);
```

You **can** add DynamicRoutes with a duplicate requestPath similar to how MVC attribute routes can have multiple methods with the same request URI.

## Registering a Dynamic Route into the Router
In practice, you would add logic to your `nox-request.php` file to access the router and then add the dynamic routes with the router's method `addDynamicRoute`.

```php
$dynamicRoute = new Nox\Router\DynamicRoute(
    requestMethod: "get",
    requestPath: "/test",
    isRegex: false,
    onRender: Closure::fromCallable(function() {
        return "<p>Hello world</p>";
    }),
);

$router->addDynamicRoute($dynamicRoute);
```

Now, going to **/test** in your Nox application will match to the above DynamicRoute and output **Hello world**.