# Querying Model Classes
The previous documentation outlined how to use <code>::fetch()</code> on a model class to fetch by primary key, but the majority of cases will most likely require queries to fetch collections of model classes.

## query() or queryOne()
All classes that extend `ModelClass` can call the static methods `query()` or `queryOne()`. The difference is that `query()` returns an array of classes and `queryOne()` will return a single model class or null.

Calling either with no arguments will return every single row in that object's represented database table - or the first result (in the case of `queryOne()`).

For these examples, we'll keep in line with previous articles and use the `User` class example.

```php
/** @var User[] $allUsers */
$allUsers = User::query();
```

```php
/** @var User $user */
$user = User::queryOne();
```

## Column Queries
To perform a more MySQL-like query on the columns of the model class, you can provide the `columnQuery` named argument. This introduces the use of the `ColumnQuery` Nox ORM class.

`ColumnQuery` objects have the following methods that you can call.

```php
public function startConditionGroup(): this;
public function endConditionGroup(): this;
public function and(): this;
public function or(): this;
public function where(
    string $columnName,
    string $condition,
    mixed $value,
    bool $raw = false,
): this;
```

Let's look at example of using `where` to query all accounts with a given email.

```php
use Nox\ORM\ColumnQuery

/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new ColumnQuery())
        ->where("email","=","example1@example.com"),
);
```

Alternatively, we can change the `condition` argument (the "=" argument) to "LIKE" and use the MySQL LIKE syntax. We'll use this to find any emails that contain `@gmail.com`

```php
use Nox\ORM\ColumnQuery

/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new ColumnQuery())
        ->where("email","LIKE","%@gmail.com"),
);
```

You can chain method calls on the ColumnQuery object with the other methods available.

```php
use Nox\ORM\ColumnQuery

/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new ColumnQuery())
        ->where("email","LIKE","%@gmail.com")
        ->or()
        ->where("email", "LIKE", "%@outlook.com"),
);
```

Finally, condition groups are simply sets of MySQL syntax wrapped in parentheses.

```php
use Nox\ORM\ColumnQuery

/** @var User[] $allUsers */
$allUsers = User::query(
    columnQuery: (new ColumnQuery())
        ->startConditionGroup()
            ->where("email","LIKE","%@gmail.com")
            ->and()
            ->where("username", "LIKE", "%james%")
        ->endConditionGroup()
        ->or()
        ->where("username","=","nox")
);
```

That would be the equivalent of a MySQL WHERE clause that looks like this
```mysql
WHERE (email LIKE "%@gmail.com" AND username LIKE "%james%") OR username = "nox"
```

## Result Ordering & Pagination
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

## Counting Results
Instead of calling `query()` and then using PHP's `count()`, you should instead use the `::count()` static method of a `ModelClass` - as this uses MySQL's own `COUNT()` function - which is quicker than having MySQL return every row in your requested query.

`count()` allows you to provide the `columnQuery` named argument as shown in query examples above.

```php
$numUsersWithEmails = User::count(
    columnQuery: (new \Nox\ORM\ColumnQuery())
        ->where("email","IS NOT",null),
);
```

## Saving Entire Collections
Implementations that extend the ModelClass allow you to use the available method of `save()`. However, sometimes you need to mass save a bunch of objects and running multiple queries isn't always the best option. A single query is more efficient. `::saveAll()` allows you to provide it an array of ModalClass instances that will be compiled down into a single MySQL query set and saved all at once.

```php
$user1 = ?; // Some instance of User which extends ModelClass
$user2 = ?;
$user3 = ?;

User::saveAll([$user1, $user2, $user3]);
```