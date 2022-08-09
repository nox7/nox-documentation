# Redirecting or Rewriting Requests
An attribute route can utilize return types to determine if a request should be redirected or rewritten. The difference is one will change the URL location the user is on (and depending on the status code, may be cached) and one will simply show a different view but keep the URL the same.

Why would you use one over the other? One example of a rewrite instead of a redirect is when an unauthorized user tries to access a resource they don't have access to. You would want to return a 403 HTTP response code and then show a view that signifies they don't have access to it - not changing the browser's URL.

## Performing a Redirect
```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;
use Nox\Http\Redirect;

#[Controller]
class HomeController extends BaseController{

    #[Route("GET", "/redirect-me")]
    public function homeView(): Redirect{
        // Redirect them
        return new Redirect(
            path: "/another-page",
            statusCode: 302, // 302 is temporary and doesn't cache - 301 would cache the result
        );
    }

}
```

## Rewriting a Request
Rewrites allow you to show another view at a destination route - but won't change the URL in the address bar.

```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;
use Nox\Http\Rewrite;

#[Controller]
class SettingsController extends BaseController{

    #[Route("GET", "/settings")]
    public function settingsView(): string | Rewrite{
        // This variable is just an example - it has no logic behind it here
        $userIsLoggedIn = false;
        
        if (!$userIsLoggedIn){
            return new Rewrite(
                path: "/403",
                statusCode: 403,
            );
        }else{
            return "<p>Welcome, user!</p>";
        }
    }

}
```

## Class Anatomy of Rewrite and Redirect
```php
class Redirect{
    public function __construct(string $path, int $statusCode = 302);
}
```
```php
class Rewrite{
    public function __construct(string $path, int $statusCode = 302);
}
```

Both of these objects inform the Nox router to perform special actions based on the path and status code used to construct them.