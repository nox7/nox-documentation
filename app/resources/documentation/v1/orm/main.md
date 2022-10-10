# Object Relational Mapping with Abyss
Abyss is the name given to Nox's MySQL ORM class. Unlike Laravel's Eloquent, Abyss aims to be a single-transparency window to the MySQL driver underneath. In short, using Abyss **will** make your life easier by allowing instantiating objects to map to MySQL tables, rows, and columns; but you won't have the feeling of a larger learning curve or that there is a lot going on under the hood.

The use of Abyss is mainly governed by creating your own models and that ModelClass instances to interface with the database. Rarely will you need to use the `Abyss` class on its own.

Abyss reads the database connection parameters from the `nox-env.php` file. **Abyss is not necessary to use the Nox framework**. You can simply comment out the `Abyss::loadConfig` line in your nox-request.php file to disable Abyss.

## Loading Abyss Configuration
By default, your nox-request.php file will come with an abyss configuration already preloaded.

```php
Abyss::loadConfig(__DIR__);
```
The `loadConfig` argument should always be the app root directory (not the server root) which has the `nox-env.php` file in it. If the NoxEnv class is not loaded, Abyss will attempt to require it in the directory passed to loadConfig's first argument.

In a standard installation, you will not need to call `loadConfig` anywhere but where it is already called for you, in nox-request.php.

## Synchronizing Your Models to the Database
In some frameworks this is called your "migrations". Nox prefers to consider naming it model synchronization because you are matching up your Nox models into your MySQL database.

See [Sync'ing Your Models](/docs/1.x/how-to/syncing-models) for a tutorial/explanation on how to do this.
