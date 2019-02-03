

## About task application

Task is a web application , such as:

- .


## Use adding patterns in application

- Factory for seeding
- Repository for CRUD operation of models
- Observer for update some fields
- Strategy for generate unic code from theme

## Use features of framework
- Migration, seeding
- Providers, vendors
- Models, routing,  controller, views, layauts of view
- Eloquent
- Validation
- Auth
- localization (translation)

## Depences
 - php > 7.2
 - php intl, 
 - php mb_string
 - vendors of laravel
 - bootstrap

## Install application

composer install
composer dump-autoload
php artisan migrate
php artisan db:seed

 
## Testing application
- php cs 
   vendor\bin>phpcs.bat   --standard=PSR2 --extensions=php,inc,lib .\..\..\app
- unittest and functional test
  php.exe -dxdebug.coverage_enable=1 /vendor/phpunit/phpunit/phpunit --coverage-clover coverage\task_laravel$tests.xml --configuration phpunit.xml task-laravel\tests --teamcity
testcoverage : 80%
max Cyclomatic Complexity : 8 (repository)
max CRAP : 2 (in Auth)

- sequrity test
- load test