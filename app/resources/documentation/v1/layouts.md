# Render Engine Layouts
A layout is a parent to a view in MVC architecture. Your view file will be rendered into a layout file. A layout file helps centralize components of your website views in order to avoid repetition.

For example, there's no need to write the HTML tags or body tags in every one of your views. In some cases, you have meta tags that are unnecessary to repeat in each view file. A layout helps reduce this overhead.

## Basic Layout File Example
A layout file is very simple syntactically and introduces no new syntax.
```html
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $htmlHead ?>
    </head>
    <body>
        <?= $htmlBody ?>
    </body>
</html>
```

### PHP Variables Available to a Layout Scope
In the above example you'll notice two PHP variables without clear in-file definition. Both `$htmlHead` and `$htmlBody` are upvalues declared by the Nox rendering engine. They will encompass the body and head components that your view file has.

Additionally, controller methods that use the `Renderer::renderView()` call can optionally pass in custom variables (shown in an example call from a controller method below). These variables are available to you in the `$viewScope` variable.
```php
Renderer::renderView("my-view.html", [
    "someVariable":"hello",
]);
```

Your layout can access the `someVariable` in this manner.

```html
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $htmlHead ?>
    </head>
    <body>
        <?= $htmlBody ?>
        Variable: <?= $viewScope['someVariable'] ?>>
    </body>
</html>
```