# Creating Custom Method Attributes
You can obviously add any additional attributes you'd like to your routable methods in controllers, but in order to create an attribute that can determine whether a route is used or not has a pattern.

Let's use an example where you want a route to only be routable if there is a user logged in on your website. We'll call this custom route `#[RequireLogin()]`.

## Barebones Custom Routable Attribute
Below is the minimum skeleton of a custom route that the Nox Router will check to determine if a route method will be considered.

```php
<?php

    use Nox\Router\AttributeResponse;
    use Nox\Router\Interfaces\RouteAttribute;

    // Tell the attribute it can only be used on class methods
    #[Attribute(Attribute::TARGET_METHOD)]
    class RequireLogin implements RouteAttribute{

        public function getAttributeResponse(): AttributeResponse
        {
            // This will cause the attribute to always return
            // that it can be routed just fine.
            return new AttributeResponse(
                isRouteUsable: true,
            );
        }
    }
```

### Restricting the Route From Being Used
Now, we can implement logic (assuming you have your own User system in place) and check for a current user. If there is one, allow the route to continue. However, if there is no user then we can send a 403 response code. Optionally, you can provide the parameter `newRequestPath` to **rewrite** (not redirect) the request to a different route and thus a different view. This is useful of you want the URI to still stay the same (as in, still say `/page-name `in the URL bar) but show your custom 403 page.
```php
<?php
    use Nox\Router\AttributeResponse;
    use Nox\Router\Interfaces\RouteAttribute;

    // Tell the attribute it can only be used on class methods
    #[Attribute(Attribute::TARGET_METHOD)]
    class RequireLogin implements RouteAttribute{

        public function getAttributeResponse(): AttributeResponse
        {
            // Your code to fetch the current user logged in
            $currentUser = ...

            if ($currentUser === null) {
                return new AttributeResponse(
                    isRouteUsable: false,
                    responseCode: 403,
                    // Optionally, rewrite the request
                    // newRequestPath: "/errors/403",
                );
            }else{
                return new AttributeResponse(
                    isRouteUsable: true,
                );
            }
        }
    }
```
You do not need to provide the `responseCode` parameter. The **only required parameter in the AttributeResponse** constructor is `isRouteUsable`.

By providing only the *isRouteUsable*, the attribute will not stop the router from looking for other routes. **Only provide other parameters** if you want the route to discontinue searching for more routes if your attribute doesn't pass.

Your method attribute can then be added to a controller method like so.

```php
#[Route("/user/dashboard")]
#[RequireLogin()]
public function userDashboardView(): string{
    // Code here will only run if a user is logged in
    // No need to check for one here
    return "&lt;p&gt;Dashboard!&lt;/p&gt;";
}
```