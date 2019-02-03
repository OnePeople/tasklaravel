

## About application
Online application - System of task.

### Use case of application:
1. create demo of user data and tasks
2. create, view, edit, delete users (fields name, email, password)
3. create, view, edit, delete tasks,
the task must contain data - subject, code, content, status, type, creator, performer, time of creation.
4. all input data must be validated
5. tasks can have different statuses
6. tasks must have an owner
7. tasks must have a executor
8. tasks can be of two types: task and problem
9. when deleting users, the tasks associated with it should be deleted (it does not work on hosting, because foreign keys in the MyISAM table are not supported)
10. There should be reports - the number of tasks of all status (in percent).
11. The application must generate a unique short code based on its theme of task.
12. all classes should be covered by unit tests,
classes working with databases and with controllers should be covered by functional tests

## Install application

1. create two database for application and unittest (data in .env file and in phpunit.xml)
2. install application
> composer install

> composer dump-autoload

> php artisan migrate

> php artisan db:seed

Demo online project http://tasklaravel.kl.com.ua

## In project use patterns
- Factory for seeding
- Repository for CRUD operation of models
- Observer for update some fields
- Strategy for generate unique code from theme
- MVC

## Use features of framework
- Migration, seeding
- Providers, vendors
- Models, routing, controller, views, layauts of view
- Eloquent
- Validation
- Auth
- localization (translation)
- unit tests
- functional test (via crawler)

## Depenses
 - RDBMS - MYSQL
 - php version > 7.2
 - php extension intl 
 - php extension mb_string
 - php extension xdebug
 - vendors of laravel
 - bootstrap library
 
## Testing application
- run php cs:
   vendor\bin>phpcs.bat   --standard=PSR2 --extensions=php,inc,lib .\..\..\app
- run unittest and functional test:
  php -dxdebug.coverage_enable=1 /vendor/phpunit/phpunit/phpunit --coverage-clover coverage\task_laravel$tests.xml --configuration phpunit.xml task-laravel\tests --teamcity
  
 ## php CS testing results 
 ✓ standard PSR2 - ok
 
 ## sequrity testing results 
 ✓ VEGA Testing - ok
- use CSRF TOKEN
- use crypt cookies
- use validate all input data
- use pattern front controller
- use escape output data (via blade)
- use different folder for public and script data 
- need use -  https protocol

## Coverage and cyclomatic complexity
- testcoverage : 92%
- max Cyclomatic Complexity of class : 11 (repository)
- max CRAP (Change Risk Analysis and Predictions): 6 (in App\Http\Middleware\Authenticate)

![alt tag](https://github.com/OnePeople/tasklaravel/blob/master/test-cover-1.png)
![alt tag](https://github.com/OnePeople/tasklaravel/blob/master/test-cover-2.png)
![alt tag](https://github.com/OnePeople/tasklaravel/blob/master/test-cover-3.png)
![alt tag](https://github.com/OnePeople/tasklaravel/blob/master/test-cover-4.png)
![alt tag](https://github.com/OnePeople/tasklaravel/blob/master/test-cover-5.png)


 ### Unit and functional testing results 
 #### Functional\Auth
   ✓ Registration page 
   
   ✓ Login page 
   
   ✓ Redirect if authenticated 
#### Functional\HomePage
   ✓ Index page 
#### Functional\Seeding
   ✓ Seeding 
#### Functional\TaskRepository
   ✓ Create 
   
   ✓ Find 
  
   ✓ Update 
  
   ✓ Delete 
  
   ✓ Report by status with data set "cnt_none_zero" 
  
   ✓ Report by status with data set "cnt_zero" 
  
   ✓ Report count with data set "cnt_null_zero" 
  
   ✓ Report count with data set "cnt_zero" 
#### Functional\Task
   ✓ Index 
  
   ✓ Creating 
  
   ✓ Creating incorrect 
  
   ✓ Show existing 
  
   ✓ Show not existing 
  
   ✓ Update 
  
   ✓ Delete 
#### Functional\UserRepository
   ✓ Create 
  
   ✓ Find 
  
   ✓ Update 
  
   ✓ Delete 
#### Functional\User
  
   ✓ Index 
  
   ✓ Creating 
  
   ✓ Creating incorrect 
  
   ✓ Show existing 
  
   ✓ Show not existing 
  
   ✓ Update 
  
   ✓ Delete 
#### Unit\Events\CodeStrategy
  
   ✓ Code generator with data set #0 
  
   ✓ Code generator with data set #1 
  
   ✓ Code generator with data set #2 
    
   ✓ Code generator with data set #3 
  
   ✓ Code generator with data set #4 
#### Unit\Events\TaskEvent
   ✓ Task user creator not auth 
  
   ✓ Task user creator are auth 
  
   ✓ Code generator with data set #0 
  
   ✓ Code generator with data set #1 
  
   ✓ Code generator with data set #2 
  
   ✓ Code generator with data set #3 
  
   ✓ Code generator with data set #4 
#### Unit\Models\TaskStatus
  
   ✓ List 
  
   ✓ Random 
  
   ✓ Default 
#### Unit\Models\Task
  
   ✓ Rules 
  
   ✓ Types 
  
   ✓ Statuses 
  
   ✓ Creator 
  
   ✓ Performer 
#### Unit\Models\TaskType
  
   ✓ List 
  
   ✓ Random 
  
   ✓ Default 
#### Unit\Models\User
  
   ✓ Rules 