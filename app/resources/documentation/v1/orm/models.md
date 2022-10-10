# Abyss ORM Models
A model is a native syntax representation of (in Nox's case) a MySQL table and its columns. Instead of manually creating the table and columns in MySQL syntax or through a tool such as phpMyAdmin, you can keep all of your logic in one language - PHP.

## Building a Model
All of your models should be in your Nox application models directory. By default, this is the `app/models` directory. This is configured in the `nox.json` file.

You **must have an existing database** before making and synchronizing your models. Nox does not create a database for you, only the tables via the models. Your database should then be configured for Abyss in the **nox-env.php** class file as constants.

Below is an example model that represents a Users table in MySQL with defined columns.

```php
<?php
    use \Nox\ORM\ColumnDefinition;
    use \Nox\ORM\Interfaces\MySQLModelInterface;
    use \Nox\ORM\MySQLDataTypes\Integer;
    use \Nox\ORM\MySQLDataTypes\VariableCharacter;

    class UsersModel implements MySQLModelInterface {

        /**
         * The name of this Model in the MySQL database as a table
         */
        private string $mysqlTableName = "users";

        /**
         * The string name of the class this model represents and can instantiate
         */
        private string $representingClassName = "User";

        public function getName(): string{
            return $this->mysqlTableName;
        }

        public function getInstanceName(): string{
            return $this->representingClassName;
        }

        public function getColumns(): array{
            return [
                new ColumnDefinition(
                    name:"id",
                    classPropertyName: "id",
                    dataType : new Integer(),
                    defaultValue: 0,
                    autoIncrement: true,
                    isPrimary: true,
                    isNull:false,
                ),
                new ColumnDefinition(
                    name:"name",
                    classPropertyName: "name",
                    dataType : new VariableCharacter(65),
                    defaultValue: "",
                ),
                new ColumnDefinition(
                    name:"email",
                    classPropertyName: "email",
                    dataType : new VariableCharacter(65),
                    defaultValue:"",
                ),
                new ColumnDefinition(
                    name:"creation_timestamp",
                    classPropertyName: "creationTimestamp",
                    dataType : new Integer(),
                    defaultValue: time(),
                ),
            ];
        }
    }
```

This tells the Abyss ORM how to build or synchronize with a table named `users` in your MySQL database.

Important notes about models in Nox:

<div class="alert alert-primary">
	<ul class="m-0">
		<li>Column definition order is retained</li>
		<li>You must run model synchronization for the models to load into your MySQL database (see <a href="/docs/1.x/how-to/syncing-models">Sync'ing Your Models</a>)</li>
		<li>The model will build and create the table if it doesn't exist, otherwise it will make sure all columns exist in the exact form you outline</li>
		<li>Columns that <strong>are not</strong> defined in the model, but <strong>do</strong> exist in the MySQL database will not be removed. You will have to delete unused columns manually. This is a data protection measure.</li>
	</ul>
</div>
}