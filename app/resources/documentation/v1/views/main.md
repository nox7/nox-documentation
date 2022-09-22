# Render Engine Views
Views are the final result of a rendered page and represent the bulk of what a user will see. This contains the page's primary content in MVC architecture.

Views require a parent layout. Nox views introduce a small markup to section the HTML head, body, and then define the layout the view uses. Other than that, a view introduces no additional syntax and you can continue to use standard PHP code and tags as you see fit.

## A Basic Example
Below is a view that will define a layout in the Nox project's layouts folder named *base.php*.

```html
@Layout = "base.php"
@Head{
    <title>Home Page</title>
}
@Body{
    <h1>Home page</h1>
    <p>
        This is the home page view.
    </p>
}
```
### Using PHP In Your View
Simply put, there is no custom syntax in a view other than the basic markup above. You can continue to use PHP output and processing tags in your view like you would anywhere else.

```html
<?php
    $variable = "Hello!";
?>
@Layout = "base.php"
@Head{
    <title>Home Page</title>
}
@Body{
    <h1>Home page - <?= $variable ?></h1>
    <p>
        This is the home page view. Math: <?= 1+1 ?>
    </p>
}
```

## Rendering a View
Rendering a view from your controller route method utilizes the `Renderer::renderView()` method. It simply returns a string (which is the final HTML to serve to the user).

An example controller is below that will render the <em>home.php</em> view file.

```php
<?php
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\RenderEngine\Renderer;
    use Nox\Router\BaseController;

    #[Controller]
    class HomeController extends BaseController{

        #[Route("GET", "/")]
        public function homeView(): string{
            header("content-type: text/html; charset=utf-8");

            return Renderer::renderView("home.php");
        }

    }
```