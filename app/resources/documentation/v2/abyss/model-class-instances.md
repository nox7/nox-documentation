# Model Class Instancs - Representing Database Rows in PHP as Objects
The Abyss ORM goes a step further than just creating models to represent database tables and columns. You can also have a class represent a row in a database and perform quick operations on this class. Then, you can save, create, or delete in the MySQL table that the class represents all without using MySQL syntax. Pure PHP.

## How Does a Model Know Which Class Represents It?
If you look back at the [models documentation page](/docs/2.0/orm/models), you will notice there is a property in the example model code that looks like this.

```php
private string $representingClassName = User::class;
```

In every model you create, you can define the string name of the class that will represent it. **Note:** The name is namespace sensitive so if you create classes inside a namespace, you must include the full namespace of that class in your model's `$representingClassName` property.

## Example of a User Class to Represent the UsersModel
In the model documentation page, the example code shows a `UsersModel` being created. Now say you want to create a class to represent a single user in the database, be able to query them, update them, create them, etc.

Below is a bare-bones example that follows the properties outlined in the models' documentation page.

```php
<?php
    use Nox\ORM\Interfaces\ModelInstance;
    use Nox\ORM\Interfaces\MySQLModelInterface;
    use Nox\ORM\ModelClass;

    class User extends ModelClass implements ModelInstance
    {
        // Because the $id is defined as the primary column, default it to null.
        // Upon calling the save method on this model - or using a query to get this model class
        // this property will be hydrated by the ORM.
        public ?int $id = null;
        public string $name;
        public string $email;
        public int $creationTimestamp;

        public static function getModel(): MySQLModelInterface{
            return new UsersModel();
        }

        public function __construct(){
            parent::__construct($this);
        }
    }
```

The public properties of this class **must**, at minimum, define the columns of the model the class represents. Refer to the UserModel in the models' documentation page. The ColumnDefinition's `classPropertyName` must match a public property in the User model.

## What can I do with the Users model?
Now, when a new user is constructed the default values in the class' model are applied to the correlating public properties.

```php
$user = new User();
```

For example: in the above code, because the User's model (UserModel) defines the creation_timestamp as an integer with a default value of `time()`, then accessing the property `->creationTimestamp` will provide the current UNIX time.

However, you will notice that the `id` property is still null.

```php
$userID = $user->id;
// null
```

This is because the user class has been instantiated, but has not been saved to the database. All model classes must extend the `ModelClass` and implement the `ModelInstance` to be considered valid in the Nox ORM. This will provide access to useful methods such as `save()`, `delete()`, and static methods `::saveAll()`, `::fetch()`, and `::query()`.

After calling `save()` on the newly instantiated user, a database row will be created for it and the id property will be filled.

```php
$user->save();
print($user->id);
// 1
```

Calling <code>save()</code> again will not create a new user. It will update the existing user. This is controlled by checking if class's primary key (defined by the model, UsersModel as <code>id</code>) is non-null.

## Fetching a User by ID (The Model Primary Key)
Following the above code example, you can use the static methods that User has inherited to fetch a model class by its primary key.

```php
/** @var User $user */
$user = User::fetch(1); // Fetches user with ID 1
```

A PHPDoc typehint is used here because PHP doesn't allow parent classes to dynamically type-hint a child class. So fetch type-hints a `ModelClass` will be returned. In this case, for editors that support intellisense, the typehint will tell the editor that the object returned is actually of `User` instance. The typehint is **not** necessary, but helps with automatic code completion in supported editors.

## Fetching/Querying a Collection of ModelClass Instances
To fetch a collection of model classes (Users in this case), you will want to use the static method `::query()`. Read more in-depth on this in the [making queries](/docs/2.0/orm/making-queries) on model classes documentation page.

## Saving a Collection
To ease the burden of network payload overhead, it is best not to loop a large collection of model classes and call `save()` on each one individually. If you have a collection of users, such as below, you can save them in one MySQL request using `::saveAll()` on your model class.

```php
$user1 = User::fetch(1);
$user2 = User::fetch(2);
$user3 = User::fetch(525);
$user1->email = "example1@example.com";
$user2->email = "example2@example.com";
$user3->email = "example3@example.com";

User::saveAll([$user1, $user2, $user3]);
```

This will either create a database entry for each individual user, or save them via an UPDATE query.

## Deleting a ModelClass Instance from the Database
To delete a model class instance (a row) from the database, simply call `delete()` on the instance. This will require that the instance have a primary key defined in its representing model and that the primary key be non-null.

```php
$user = User::fetch(105);
$user->delete();
```