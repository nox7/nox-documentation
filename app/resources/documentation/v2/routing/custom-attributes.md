# Creating Custom Router-Recognized Attributes
Attributes are not unique to the Nox framework, however only attributes that extend from specific Nox-recognized classes will be used and checked when routing.

## Basic Attribute for Nox Controllers
Any attribute you want the Nox router to use must implement the `RouteAttribute` interface. This will require a definition of `getAttributeResponse` that returns an `AttributeResponse`. That AttributeResponse contains the information for the Nox router to determine if the router the attribute is on is usable.

An example of a basic attribute that the Nox router will use is below. This attribute currently does nothing.
```php
use Attribute;
use Nox\Router\AttributeResponse;
use Nox\Router\Interfaces\RouteAttribute;

// Tell the attribute it can only be used on class methods
#[Attribute(Attribute::TARGET_METHOD)]
class ExampleAttribute implements RouteAttribute{

    public function getAttributeResponse(): AttributeResponse
    {
        return new AttributeResponse(
            isRouteUsable: true,
        );
    }
}
```

It can then be placed on a method (because we used the PHP constant `Attribute::TARGET_METHOD` to restrict where this attribute can be used).

## Restricting the Route From Being Used
Now, we can implement logic. For this example, we'll create a route that checks for the *presence* of an `Authorization` header. We won't actually check the value of this header, but only if it exists. 

```php
use Attribute;
use Nox\Router\AttributeResponse;
use Nox\Router\Interfaces\RouteAttribute;

// Tell the attribute it can only be used on class methods
#[Attribute(Attribute::TARGET_METHOD)]
class CheckForAuthorizationHeader implements RouteAttribute{

    public function getAttributeResponse(): AttributeResponse
    {
        $headers = getallheaders();
        
        foreach($headers as $headerName=>$headerValue){
            if (strtolower($headerName) === "authorization"){
                return new AttributeResponse(
                    isRouteUsable: true,
                );
            }
        }
       
        return new AttributeResponse(
            isRouteUsable: false,
        );
    }
}
```

This route can be placed on a controller method to have the router skip routing that method if there is no authorization header.

Below is a class method example stub.
```php
#[Route("get","/")]
#[CheckForAuthorizationHeader]
public function restrictedView(): string{
    // Code here would only run if both routes are usable
}
```

## Additional Options: Halting Routing or Redirecting
The constructor of the `AttributeResponse` class has two additional (and optional) parameters that can give you a little more control over whether the Nox router should simply skip over the method - or if it should stop the routing process and return some HTTP status and/or rewrite the request.

```php
class AttributeResponse{
    public function __construct(
        public bool $isRouteUsable,
        public ?int $responseCode = null,
        public ?string $newRequestPath = null
    );
}
```

By providing **either** a `responseCode` or a `newRequestPath` (you can also provide both) the Nox routing system will stop routing at that point. You can have it then simply respond with a blank HTTP body and just the response code - or the response code **and** rewrite the request to another route.

An example definition of responding with a 403 HTTP status and rewriting it to some custom 403 view page is below.

```php
use Attribute;
use Nox\Router\AttributeResponse;
use Nox\Router\Interfaces\RouteAttribute;

// Tell the attribute it can only be used on class methods
#[Attribute(Attribute::TARGET_METHOD)]
class CheckForAuthorizationHeader implements RouteAttribute{

    public function getAttributeResponse(): AttributeResponse
    {
        $headers = getallheaders();
        
        foreach($headers as $headerName=>$headerValue){
            if (strtolower($headerName) === "authorization"){
                return new AttributeResponse(
                    isRouteUsable: true,
                );
            }
        }
       
        return new AttributeResponse(
            isRouteUsable: false,
            responseCode: 403,
            newRequestPath:"/403" 
        );
    }
}
```

**Note**: There is no magical /403 route if you didn't define one. You would have to create a route method for the `/403` route and respond with your own view. If you want just a blank response and a 403 status, then omit the `newRequestPath` parameter.