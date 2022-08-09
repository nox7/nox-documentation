# Serving Static Files
The location of where Nox will look for your static files (images, CSS, JavaScript, etc) is configured, by default, in the <code>nox-request.php</code> file by a specific call shown below.

```php
$nox->addStaticDirectory(
    uriStub: "/",
    directoryPath: __DIR__ . "/resources/static",
);
```

This means that any URIs that start with "/" (which all do) will first check if that URI path is actually a file bath relative to the directoryPath parameter (app/resources/static for default installations).

Additionally, only recognized MIME types will be considered serveable files. Just because a file path is valid and exists <strong>does not mean it will not return a 404/not found</strong> if you have not registered that file extension as a valid MIME type Nox can understand.

<a class="btn btn-primary" href="/docs/2.0/nox-configs/registering-mime-types">
    <i class="bi bi-file-binary-fill"></i>
    <span>More on Registering File Extensions</span>
</a>

## Multiple Static Directories
By default, only one static directory check is registered and its registered as the root path of all requests. You can, however, virtually map a URI stub to a separate static directory.

For example, if you want all URIs that start with /backend to check a different static folder than your standard front-end pages, you can adjust the uriStub and change the directoryPath parameters.

```php
$nox->addStaticDirectory(
    uriStub: "/",
    directoryPath: __DIR__ . "/resources/static",
);
$nox->addStaticDirectory(
    uriStub: "/backend",
    directoryPath: __DIR__ . "/resources/admin-statics",
);
```

These directives and settings would go in the <code>nox-request.php</code> project file before a call to <code>$nox->router->processRequestAsStaticFile()</code> is made.