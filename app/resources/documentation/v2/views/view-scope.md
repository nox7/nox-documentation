# View Scope - Providing Variables Directly to Your View
When a view is rendered, you can optionally provide direct data from your controller into the view's scope. (For reference, these data is also available to whatever layout is being rendered because of inheritance when the view is rendered).

## Passing the Data in the Controller
The `Renderer:renderView()` function accepts the parameter viewScope to inject into the view being rendered. This is the data you would like to pass to your view.

```php
<?php
    use Nox\RenderEngine\Renderer;
    use Nox\Router\Attributes\Controller;
    use Nox\Router\Attributes\Route;
    use Nox\Router\BaseController;

    #[Controller]
    class HomeController extends BaseController{

        #[Route("/")]
        public function homeView(): string{
            return Renderer::renderView(
                viewFileName:"home.php",
                viewScope:[
                    "test"=>"Hello world",
                ],
            );
        }

    }
```

## Accessing the View Scope
All views have an array variable injected into their PHP scope called `$viewScope`. Your injected variables live as string indices in this array.

Following the code pattern above, the home.php view file could access the `test` variable in the following way.

```php
<?php
    // PHPStorm array shape definition for type hinting
    /** @var array{test: string} $viewScope */
    $test = $viewScope['test']
?>
@Layout = "base.php"
@Head{
    <title>Home Page</title>
}
@Body{
    <p>
        Variable is <?= $test ?>
    </p>
}
```