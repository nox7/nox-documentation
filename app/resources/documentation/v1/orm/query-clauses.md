# Query Clause Classes
Nox's ORM provides class representation of certain MySQL query clauses. These clause objects are used when making queries against a ModelClass instance (such as a User class).

## The ColumnQuery Class
The main methods of interest in a ColumnQuery are as follows

```php
public function where(string $columnName, string $condition, string $value);
public function or();
public function and();
public function startConditionGroup();
public function endConditionGroup();
```

An example of creating a ColumnQuery that represents the below MySQL clause is shown below
```mysql
WHERE (email LIKE "%example%" AND name LIKE "nox%") OR (id = 1)
```
```php
$columnQuery = new \Nox\ORM\ColumnQuery()
    ->startConditionGroup() // Start a parenthesis group
    ->where("email", "LIKE", "%example%")
    ->and()
    ->where("name", "LIKE", "nox%")
    ->endConditionGroup() // close the parenthesis group
    ->or()
    ->where("id", "=", 1)
```

The first parameter of `where()` is the **actual MySQL column name** and not the property name represented in the model class. The synatx of the `where()` parameters is MySQL syntax. So to check against null you would write

```php
->where("email", "IS NOT", "NULL")
```

```php
->where("email", "IS", "NULL")
```

<div class="alert alert-primary">
	All clauses are query built as prepared queries or escaped queries (in the case of a multi-query situation, such as when saving a collection).
</div>

## ResultOrder
The `ResultOrder` class is a simpler class that represents how to order a query's result set. It has only one method of interest

```php
public function by(string $columnName, string $order);
```

```php
$resultOrder = new \Nox\ORM\ResultOrder()
    ->by("email", "ASC");
```
Multiple `by()`'s can be strung together to have multiple orderings - just as MySQL natively allows.

## Pager Class
The Pager class is the simplest clause class and represents how a query's result set will be limited and offset. It has no methods and simply uses properties in its constructor

```php
$pager = new \Nox\ORM\Pager(
    pageNumber: 1,
    limit: 100,
);
```