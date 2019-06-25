# "Task list" demo application (server side entry point)

> Сменить язык: [![Русский](docs/assets/images/ru.gif)](README.ru.md) [![English](docs/assets/images/en.gif)](README.md)

###### Author: MrDigger <mrdigger@mail.ru>
###### © SAD-Systems [http://sad-systems.ru](), 2019

## Is used

  * [PHP 7.1](https://www.php.net)
  * [graphql-php](https://webonyx.github.io/graphql-php/)
    
## Notes

This repository contains the server side implementation only. 
It represents the API entry point.
The client side interface is placed in [tasklist-service-frontend](https://github.com/sad-systems/example-tasklist-service-frontend)
repository.
 
The application uses GraphQL technology to provide service.
GraphQL is a modern way to build HTTP APIs consumed by the web and mobile clients. 
It is intended to be an alternative to REST and SOAP APIs.   
    
## Description

This application implements a test exercise, the main goal of which is to demonstrate
interaction between client and server using GraphQL technology.

### Formulation of the problem:

You need to create a "task tracker".

The tasks consist of:
- username;
- e-mail;
- task text;

Key features:
- The start page should contain a list of tasks with the ability to sort by user name, email and status.
- The output of tasks must be done in pages of 3 pieces (with pagination).
- To see the list of tasks and create new can any visitor without authorization.
- There must be an administrator login (username "admin", password "123").
The administrator has the ability to edit the text of the task and put a check mark on the implementation.
- Completed tasks in the general list are displayed with the corresponding mark.


### Live demo

Try the [live demo](http://tasklist.frontend.examples.sad-systems.ru/)
  
Use:
   
  * username: admin
  * password: 123
     
to get the access to edit tasks.
 
### Project source files

  All the files are placed under the [/src](./src) folder

### Installation

```
composer install
```