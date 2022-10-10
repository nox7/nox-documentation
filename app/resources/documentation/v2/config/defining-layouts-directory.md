# Defining a Layouts Directory
The Nox rendering engine, when rendering a view, expects that view file to have defined a @Layout directive. This tells the rendering engine which layout file the view to be rendered will be a part of.

The layout file defined in the view file with the @Layout directive is a relative file path from the directory you tell the Nox object to use for layouts.

```php
$nox->setLayoutsDirectory(__DIR__ . "/resources/layouts");
```

Think of a layout as the HTML that a view is placed into - for example, the doctype, the HTML tags, body tags, and head tags would all typically go int the layout file. Your view would then have the contents for the head and body.

A layout allows you to have reusable HTML across a wide set of views.