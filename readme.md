

## About task application
Online application - System of task.

### Use case of application:
1. create demo of user data and tasks
2. create, view, edit, delete users (fields name, email, password)
3. create, view, edit, delete tasks,
the task must contain data - subject, code, content, status, type, creator, performer, time of creation.
4. all fields must be validation
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

## Depences
 - php > 7.2
 - php intl, 
 - php mb_string
 - vendors of laravel
 - bootstrap
 
## Testing application
- run php cs:
   vendor\bin>phpcs.bat   --standard=PSR2 --extensions=php,inc,lib .\..\..\app
- run unittest and functional test:
  php -dxdebug.coverage_enable=1 /vendor/phpunit/phpunit/phpunit --coverage-clover coverage\task_laravel$tests.xml --configuration phpunit.xml task-laravel\tests --teamcity
  
 ### Testing results 
testcoverage : 92%
max Cyclomatic Complexity : 8 (repository)
max CRAP : 2 (in Auth)
- php cs - ok
- sequrity test -ok
- load test
