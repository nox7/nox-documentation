# Redirecting &amp; Rewriting Requests
An attribute route (non-dynamic routes) can utilize return types to determine if a request should be redirected or rewritten. The difference is one will change the URL location the users is on (and depending on the status code, may be cached) and one will simply show a different view but keep the URL the same.

## Performing a Redirect
```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;
use Nox\Http\Redirect;

#[Controller]
class HomeController extends BaseController{

    #[Route("GET", "/")]
    public function homeView(): Redirect{
        // Redirect them
        return new Redirect(
            path: "/some-other-page",
            statusCode: 302, // 302 is temporary and doesn't cache - 301 would cache the result
        );
    }

}
```

## Rewriting a Request
Sometimes you simply want to perform a rewrite and, under the hood, cause the request to route to a different route method. Why would you want to do this? Maybe you want to show your /403 route result for an unauthorized user visiting a settings page.

```php
use Nox\Router\Attributes\Controller;
use Nox\Router\Attributes\Route;
use Nox\Router\BaseController;
use Nox\Http\Rewrite;

#[Controller]
class SettingsController extends BaseController{

    #[Route("GET", "/settings")]
    public function settingsView(): string | Rewrite{
        // Jargon variable, but is for an example
        if ($userIsNotLoggedIn){
            return new Rewrite(
                path: "/403",
                statusCode: 403,
            );
        }else{
            return "Welcome, user!";
        }
    }

}
```