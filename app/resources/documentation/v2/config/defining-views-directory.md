# Defining a Views Directory
When you serve a view file from a standard controller result, the Nox Renderer needs to know where to look for your view file relative path.

A typical call to the `Renderer::renderView` will need a viewFileName parameter - which is a string relative path to a view file from your configured views directory.

In the file you set up the Nox object (typically in nox-request.php) you would need to have the following definition before processing routes.

```php
$nox->setViewsDirectory(__DIR__ . "/resources/views");
```

Then, when you call the renderView method of the Renderer, you would provide a relative path. Let's assume there is a folder in your views called `about` and a file called `main.php`.

```php
// $renderedPage is a string of the full HTML render of that main.php file
$renderedPage = \Nox\RenderEngine\Renderer::renderView(
    viewFileName: "about/main.php",
);
```