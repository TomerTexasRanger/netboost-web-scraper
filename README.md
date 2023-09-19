# netboost-web-scraper

#Best used with PHP storm.

#clone repository.

#run command "docker-compose up -d"

#wait for installation to complete

#run "docker exec -it laravel_worker bash"

#in the laravel_worker container run "composer install"

#wait for installations to complete

#open new console tab and and navigate to "laravel-app" container (cd laravel-app)

#press "t" followed by "Tab", now you should be in the "laravel-app" container

#run composer install.

#open new console tab and navigate to angular file (cd angular-app)

#run "npm install"

#wait for installation to complete

#run npx ng serve.

#open new console tab and again navigate to angular-app (cd angular-app)

#run  "laravel-echo-server start"

#in the "laravel_worker" console tab, run command "php artisan queue:work"

#open web browser at "http://localhost:4200"

use app. 


p.s: if the queue is failing for some reason, you can use the server asynchronislly by uncommenting "TargetController" line 24 and "App\Services\Target\Crud\StoreService" line 86.

