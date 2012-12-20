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

### The View

```PHP
foreach($iterator as $key => $value){
    echo 'Returned field ', $value['field'],
        'Is in the position ', $key;
}

```

This code is very generic and its meant to be written with an array in mind and we will try to use that same code for our iterator.

### Constructor method

```PHP
<?php

class StatementIterator implements Iterator{
    protected $statement, $key = 0, $value;

    public function __construct(\PDOStatement $statement){
        $this->statement = $statement;
    }
}
```

Notice the ` \ ` before the PDOStatement classes to avoid namespaces conflicts.

### Rewind method

The rewind method is executed when the foreach starts.

```PHP
    public function rewind(){
        $this->key = 0;
        if ($this->statement->execute())
            $this->value = $this->statement->fetch();
        }
    }
```

Due to how rewind is handled we can't use add parameter statement execute method.

We also can't add a validation on the rewind method as we normally would (by returning false on error) since the return rewind method is meant to return void (`foreach` won't check it). To solve this we can implement two solutions.

#### Store the execution response 

```PHP
    public function rewind(){
        $this->key = 0;
        if ($this->statement->execute()) {
            $this->value = $this->statement->fetch();
        } else {
            $this->value = false;
        }
    }
```

The `$value` property will store the response and show it when the `foreach` ask the validation.

The sql error won't get catched, it will go silently ignored by the `foreach`.

#### Throw and exception

```PHP
    public function rewind(){
        $this->key = 0;
        if ($this->statement->execute()) {
            $this->value = $this->statement->fetch();
        } else {
            throw new \PDOException('Error executing SQL statement code number'
                . $this->statement->errorCode();
            );
        }
    }
```

Which one to use depends mostly of the developer and how the View handles the exceptions.

### Valid method

This method returns boolean and will be the one to be validated by the foreach.

```PHP
    public function valid(){
        return (bool) $this->value;
    }
```

The statement were fetched, the result stored and checked.

### Current method

The result of this method will be stored in the `$value` variable on the `foreach` statement.

```PHP
    public function current(){
        return $this->value;
    }
```

### Key method

The result of this method will be stored in the `$key` variable on the `foreach` statement.

```PHP
    public function key(){
        return $this->key;
    }
```

### Next method

This method will be called everytime the `foreach` method advance to the next iteration.

```PHP
    public function next(){
        $this->key++;
        $this->value = $this->statement->fetch();
    }
```

### PDOStatment methods

At this point we have developed a functional class that fully implements the iterator. Now lets focus on creating an interface for the PDOStatement
