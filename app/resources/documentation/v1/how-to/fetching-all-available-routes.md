# Fetching All Accessible Routes
You are able to fetch all routes that are accessible to a given HTTP request. The most common use case for this would be to dynamically generate a sitemap for web crawlers.

The Nox Router class has an exposed method `getAllAccessibleRouteURIs(bool $includeRegexRoutes = false)` that will fetch all URIs the calling HTTP session can access. It will run any extra attributes that could restrict a viewer from accessing a route (such as a `#[RequireLogin()]` attribute) and remove such URIs from the return result.

DynamicRoute objects are also included and their `onRenderCheck` closures are called as well. Removing them from the result if necessary (based on the `onRenderCheck` return value).

## Sample Code
From within a controller, you can access the router by fetching the `BaseController::requestHandler`

```php
#[Route("get", "/sitemap")]
public function getAccessibleURIs(): string{
    $router = parent::$requestHandler->router;
    $accessibleURIs = $router->getAllAccessibleRouteURIs();
    return json_encode($accessibleURIs);
}
```

From within a DynamicRoute, the scope of the `onRenderCheck` or `onRender` closure callbacks already registers the global `$this` variable as an instance of `BaseController`.

```php
new Nox\Router\DynamicRoute(
    requestMethod: &quot;get&quot;,
    requestPath: &quot;/sitemap&quot;,
    isRegex: false,
    onRender: Closure::fromCallable(function() {
        /** @var \Nox\Router\BaseController $this */
        $router = $this::$requestHandler->router;
        return json_encode($router->getAllAccessibleRouteURIs());
    }),
);
```