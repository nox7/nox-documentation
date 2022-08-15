# Object Relational Mapping with Abyss
Abyss is the name given to Nox's MySQL ORM class. Unlike Laravel's Eloquent, Abyss aims to be a single-transparency window to the MySQL driver underneath. In short, using Abyss **will** make your life easier by allowing instantiating objects to map to MySQL tables, rows, and columns; but you won't have the feeling of a larger learning curve or that there is a lot going on under the hood. Additionally, Abyss **only supports MySQL** and doesn't use PDO under the hood.

The use of Abyss is mainly governed by creating your own models and that ModelClass instances to interface with the database. Rarely will you need to use the <code>Abyss</code> class on its own.

In the standard example project, Abyss is loaded in nox-request.php and credentials are provided via a DatabaseCredentials object. You can register multiple database credentials to allow Abyss to interface with multiple databases. This is useful if your application or project spans multiple databases - as your models in Nox allow you to set which database that model has objects in.

## Loading Abyss Configuration
By default, your nox-request.php file will come with an abyss configuration already preloaded.

```php
Abyss::addCredentials(new DatabaseCredentials(
    host: NoxEnv::MYSQL_HOST,
    username: NoxEnv::MYSQL_USERNAME,
    password: NoxEnv::MYSQL_PASSWORD,
    database: NoxEnv::MYSQL_DB_NAME,
    port: NoxEnv::MYSQL_PORT,
));
```

## Synchronizing Your Models to the Database
In some frameworks this is called your "migrations". Nox prefers to consider naming it model synchronization because you are matching up your Nox models into your MySQL database.

See [Synchronizing Models to a MySQL Database](/docs/2.0/orm/synchronizing-models) for a tutorial/explanation on how to do this. By default, it is done by calling a CLI script - however, the code is portable into your standard application process should you wish it to be able to be called elsewhere.