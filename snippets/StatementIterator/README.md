Statement Iterator
==================

The MVC design pattern is omnipresent in frameworks and CMS's. This snippets assume you understand the MVC pattern and its implementation and PDO statements.

## The problem
When making a `select` query the Model will be the one retrieving the information from the database class. Most frameworks and CMS's will generate an array from the query on the database class or in the model. That can be a very big array sometimes.

Then the model pass the array to the Controller that in turn pass it to the view. Finally the View shows that array to the User.

So in total the query statement gets executed on the model or the database class. Then the result will be stored in an array which will be passed from one class to the next one untill its shown to the user.

This means that a big array will leak a lot of memory each time its passed.

## The idea

The view will most likely deploy the array using a `foreach` or something similar instead of the well known `while` used to handle statements. But they are both loops and can work the same with a few tweaks.

One way to avoid the memory leak is to create an `StatementIterator` class that behaves like an array that means its an implementation of the `Iterator`, but interface that internally behaves like an statement.

That way you can retrieve a `StatementIterator` instance which will be much smaller than the array, that instance can get passed from a class to the next one instead of the array. When the View starts to execute the `foreach` clause on the `StatementIterator` instance it will internally execute the PDO statement and do show the results to the user

So in resume this way will not leak that much memory since the statement will be at last instead of executing it at the beggining and storing the results.

## The Code

We will use PHP5.3, `PDOStatements` and the `Iterator` interface

### Constructor

```PHP
<?php

class StatementIterator implements iterator{
    protected $statement;

    public function __construct(PDOStatement $statement){
        $this->statement = $statement;
    }
}
```
