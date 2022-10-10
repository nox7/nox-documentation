# Modeling Database Tables
A Nox model is a native PHP syntax representation of a MySQL table and its columns. Instead of manually creating the table and columns in MySQL syntax or through a tool such as phpMyAdmin, you can keep all of your logic in one language - PHP.

## Building a Model
All of your models must be part of your defined project code source directory. In default projects, this is a directory called `src`.

You **must have an existing database** before making and synchronizing your models. Nox does not create a database for you, only the tables via the models.

Below is an example model that represents a **users** table in MySQL with defined columns.

```php
<?php
    namespace Users;

    use Nox\ORM\Attributes\Model;
    use Nox\ORM\ColumnDefinition;
    use Nox\ORM\Interfaces\MySQLModelInterface;
    use Nox\ORM\MySQLDataTypes\Integer;
    use Nox\ORM\MySQLDataTypes\VariableCharacter;

    #[Model]
    class UsersModel implements MySQLModelInterface {

        /**
         * The name of the database this table belongs to
         */
        private string $mysqlDatabaseName = "application_database";

        /**
         * The name of this Model in the MySQL database as a table
         */
        private string $mysqlTableName = "users";

        /**
         * The string name of the class this model represents and can instantiate
         */
        private string $representingClassName = User::class;

        public function getDatabaseName(): string{
            return $this->mysqlDatabaseName;
        }

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
?>
```

This tells the Abyss ORM how to build or synchronize with a table named **users** in your MySQL database. A model also describes which database the table belongs to - because you can setup Abyss to natively connect and access tables of multiple database in one process.

Important notes about models in Nox:

<div class="alert alert-primary">
	<ul class="m-0">
		<li>Column definition order is retained</li>
		<li>You must run model synchronization for the models to load into your MySQL database (see <a href="/docs/2/how-to/syncing-models">Sync'ing Your Models</a>)</li>
		<li>The model will build and create the table if it doesn't exist, otherwise it will make sure all columns exist in the exact form you outline</li>
		<li>Columns that <strong>are not</strong> defined in the model, but <strong>do</strong> exist in the MySQL database will not be removed. You will have to delete unused columns manually. This is a data protection measure.</li>
	</ul>
</div>

## Using the Model
To actually make use of this model, you would have to first synchronize all of your models to your database (a link above in the alert box can describe how to do that), and then create a ModelClass/ModelInstance implementation that uses a PHP object to represent each row in the model. Read about [Model Instances here](/docs/2.0/orm/model-class-instances).