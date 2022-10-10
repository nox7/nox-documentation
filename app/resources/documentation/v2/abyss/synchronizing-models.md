# Synchronizing Your PHP Models to Your MySQL Database
Now that you've built out some models for your application (if you haven't check out how to do so [on the Models article](/docs/2.0/orm/models)) - you'll need to make sure the models have MySQL tables that represent them.

Default Nox installations, made using the installation script on the [installation](/docs/2.0/installation) page, come with a folder titled *cli-scripts*. Inside this folder is a script you can run named `sync-models.php`.

This script relies on you having filled out valid MySQL credentials in the <code>nox-env.php</code> file. You **must** have already made an existing MySQL database. Nox only will create and organize your tables (from the Models you made), but will not actually create a MySQL database for you.

## Running the Synchronization Script
Once the credentials are filled out, make sure that `php` is a valid command you can run from your command line (For Windows, your PATH variable must include a path to a folder that contains a PHP executable).

Navigate to the *cli-scripts* folder and execute the *sync-models.php* script. A few moments will pass, and you should now see all the tables and columns properly created in your MySQL database to match all of your models.

```bash
$ php cli-script.php
```

## The Code for Synchronizing Models
Abyss itself has a method called `syncModels` that takes an array of ReflectionClass objects **that are expected to already be checked for the #[Model] attribute**. Abyss will iterate over these reflections and generate MySQL syntax and run that creation or update syntax.

The `sync-models.php` source is below. **It is not required** this code be ran from the CLI - you could definitely make a button in some web interface to call `syncModels` if you so desired.

```php
<?php
	require_once __DIR__ . "/../../vendor/autoload.php";
	require_once __DIR__ . "/../nox-env.php";

	use Nox\ClassLoader\ClassLoader;
	use Nox\Nox;
	use Nox\ORM\Abyss;
	use Nox\ORM\DatabaseCredentials;

	// Load the source directory
	$nox = new Nox();
	$nox->setSourceCodeDirectory(__DIR__ . "/../src");

	// Get the model reflections
	$modelReflections = ClassLoader::$modelClassReflections;

	// Load the credentials for any and all databases used by the models
	Abyss::addCredentials(new DatabaseCredentials(
		host: NoxEnv::MYSQL_HOST,
		username: NoxEnv::MYSQL_USERNAME,
		password: NoxEnv::MYSQL_PASSWORD,
		database: NoxEnv::MYSQL_DB_NAME,
		port: NoxEnv::MYSQL_PORT,
	));

	$abyss = new Abyss();

	// Sync the models to the current local MySQL database
	print("Synchronizing Models to MySQL database.\n");
	$abyss->syncModels($modelReflections);
	print("Synchronization finished.\n");
```