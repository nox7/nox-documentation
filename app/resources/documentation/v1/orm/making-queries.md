# Making Queries to Fetch Collections of Model Classes
The [previous documentation](/docs/1.x/orm/model-class-instances) outlined how to use `::fetch()` on a model class to fetch by primary key, but the majority of cases will most likely require queries to fetch collections of model classes.

## Using ::query()
An empty query will fetch every row in the MySQL table of that calling class.
```php
/** @var User[] $allUsers */
$allUsers = User::query();
```
To check for results, simply check if the array is empty or count the length of the array.

## Column Queries
To perform a more MySQL-like query on the columns of the model class (again, we will continue to use the User example), you can provide the `columnQuery` named argument.
```php
/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new \Nox\ORM\ColumnQuery())
        ->where("email","=","example1@example.com"),
);
```
This will return an array of User model class instances where their email is equal to the above clause. More on the classes, syntax, and methods of the clause classes in the Nox ORM can be found in the [query clauses documentation page](/docs/1.x/orm/making-queries/query-clauses).

## Result Ordering &amp; Pagination
The query() static also has two other named parameters that can be provided as arguments. `resultOrder` and `pager`.

```php
$perPage = 10;
$pageNumber = 1;

/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new \Nox\ORM\ColumnQuery())
        ->where("email","=","example1@example.com"),
    resultOrder: (new \Nox\ORM\ResultOrder())
        ->by("id", "ASC"),
    pager: (new \Nox\ORM\Pager(
        pageNumber: $pageNumber,
        limit: $perPage,
    )),
);
```

Again, for more specifics on the clauses classes, their syntax, and more complex queries review the [query clauses documentation page](/docs/1.x/orm/making-queries/query-clauses).

## Other Query Options</h2>
There are other quick query options available on the ModelClass as static methods.

### ::queryOne()
This method allows you a guaranteed single return to avoid having to have an array returned and then fetch the first result in the array. queryOne accepts the same three parameters that query does shown above.
```php
/** @var User $user */
$singleUser = User::queryOne(
    columnQuery: (new \Nox\ORM\ColumnQuery())
        ->where("email","=","example1@example.com"),
);
```
## ::count()
Instead of returning an array and counting the array's values, you can utilize the MySQL native COUNT function. `::count` will take a single parameter of columnQuery which is the value of Nox\ORM\ColumnQuery() that has been shown in previous examples.

```php
$numUsersWithEmails = User::count(
    columnQuery: (new \Nox\ORM\ColumnQuery())
        ->where("email","IS NOT",null),
);
```
### ::saveAll()
Implementations that extend the ModelClass allow you to use the available method of `-&gt;save()`. However, sometimes you need to mass save a bunch of objects and running multiple queries isn't always the best option. A single query is more efficient. ::saveAll() allows you to provide it an array of ModalClass instances that will be compiled down into a single MySQL query set and saved all at once.

```php
$user1 = ?; // Some instance of User which extends ModelClass
$user2 = ?;
$user3 = ?;

User::saveAll([$user1, $user2, $user3]);
```