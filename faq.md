Frequently Asked Questions

## Which resources can help me to start learning PHP from scratch?

* http://php.net/manual/en/language.basic-syntax.php
* http://php.net/manual/en/tutorial.php
* http://it-ebooks.info/tag/php/

## Which resources are considered dangerous or outdated and MUST NOT be consulted or recommended.

* w3schools.com explanation w3fools.com
* http://thephpbasics.com/
* Any resource that recommend deprecated features such as the `mysql_` functions to connect a database.

## I have many years of experience using PHP and I want to get ahead of the new technologies. Which resources can help me on that?

* http://net.tutsplus.com/category/tutorials/php/
* http://www.phptherightway.com/

## Which resources can help me to start learning OOP PHP (Object Oriented PHP)

* http://php.net/manual/en/language.oop5.php
* http://net.tutsplus.com/tutorials/php/oop-in-php

## What is PSR and why is it important?

PSR is a proposed standard for coding intended for PHP developers. You can find it here https://github.com/php-fig/fig-standards/tree/master/accepted

### The problems

#### Its hard to work with several people and tools

Something as simple as the tabulation can become a headache very quickly. Each developer have their own way of writting code, where to store files and the style of naming classes, functions and methods.

#### Interoperatibility

Packages in PHP and any other language can have problems on how to operate together. For example two different packages can define the same function named "user_sort", the same class "User" or the same file "User.php". The folder structure of each package might be different making it hard to make them work together.

If you have worked with frameworks you will know how hard it is to create and maintain extensions and almost impossible to want the same code work in more than one of them.

#### Internal Structure

PHP is a very permissive language which means you can do many things that other languages forbid. One example is declaring various classes in the same file. This give advantages but its easy to forget where you declared each class. That can eman trouble when you want to maintain your code or more people want to contribute with you.

If you want to use autoload functions then you need to figure out your file and folder structure before starting your project and decide it with the rest of your team or it simply will fail to work properly.1

#### Project communication

Each one of this problems above needs to be solved with your team everytime you start a project or want to help with an existing one.

### The solution

Propose an standard that solve all the problems above by setting a coding style guide that helps people and projects work with each other.

There is not a coding style better han other one and not a single person knows which can suit better for everyone else. So a commite were created with volunteers that are very well versed in the PHP language to vote and decide how to make this possible.

Making a project PSR compliant help to make it easier to operate with other projects, that developers can help you better and to keep an organized structure in your code.

## Which is the best framework (or better said why I must not ask that question)
It depends on the work you want to accomplish. There are lots of PHP Framework around the web. Just read http://en.wikipedia.org/wiki/Comparison_of_web_application_frameworks#PHP_2 and think what should be fit for your project. Choosing framework is totally dependent on your project types. So you know better what fits for you.

## I have experience programming in other language, what is different in PHP?

## I would like to contribute to opensource projects, where do I start?
First of all you have to go to your chosen project's homepage and found their GIT repo. Then fork it. You can get started by taking a look at http://www.github.com . You will found lots of open source projects there. Just click on there and start Fork-ing.
