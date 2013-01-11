<?php

// First we define the connection string, username and password
$dsn = 'mysql:host=localhost;dbname=mydatabase';
$username = 'username';
$password = 'secret';

// Create a new instance of the PDO object
$db = new PDO($dsn, $username, $password);

// With PDO we can use prepared statements which means we send the statement and values separately
$sth = $db->prepare('SELECT * FROM `mytable` WHERE `id`=:id');
$sth->execute(array('id' => 1));

// We can now fetch the result from the database
var_dump($sth->fetch(PDO::FETCH_ASSOC));