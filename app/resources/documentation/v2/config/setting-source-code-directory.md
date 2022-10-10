# Setting the Source Code Directory
A project has a singular location where the source code for its operation is housed. All classes, controllers, and models belong in the descendants of this source code directory.

## Auto-Loading of the Source Directory
Nox will iterate all descendants in file-tree order of the source code directory and call `require_once` on each file in the descendants tree. Rarely should you need to <code>require</code> the files in your own source code directory unless they are in opposing file-tree order.

```php
$nox->setSourceCodeDirectory(__DIR__ . "/src");
```

This method can be used outside the `nox-request.php` file, such as in a CLI script, to chronologically autoload your project source code files.

## Auto-Loading Outside of nox-request.php
An example of the above paragraph would be to create a blank Nox object and set the source code.

```php
// Load the composer dependencies and the NoxEnv
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/nox-env.php";

$nox = new Nox();
$nox->setSourceCodeDirectory(__DIR__ . "/app/src");

// You can now use your source code classes you defined in the project src
```