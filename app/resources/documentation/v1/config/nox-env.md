# The NoxEnv Pseudo Environment Class
Nox was designed to run fluidly on Apache servers, and you cannot natively provide command-line-like environment variables to the PHP processor in Apache. NoxEnv is the structured solution to this problem.

There are no explicit requirements by Nox for constants that must be placed in the `nox-env.php` file. However, the Abyss ORM does require that certain MYSQL_ constants be present should you choose to load Abyss in your application.

<div class="alert alert-danger">
	The nox-env.php is recommended to never be committed to a code repository. Instead, use the nox-env.example.php file to outline the constants your project requires and keep your API keys and other sensitives safe.
</div>

A standard `nox-env.php` file will look as follows

```php
<?php
    class NoxEnv{
        const DEV_ENV = "development";
        const MYSQL_HOST = "localhost";
        const MYSQL_PORT = "3306";
        const MYSQL_USERNAME = "root";
        const MYSQL_PASSWORD = "";
        const MYSQL_DB_NAME = "test";
    }
```

By default, this file is required in the nox-request.php and is available in the scope of your entire project.