## About This Project

This task is to build an internal API for a wallet microservice;

## Brief

We are going to have a micro-service to keep all data of user wallet. We need to have two API to expose them to other micro-services.

## Requirements for this project
You should have these requirements:
#### PHP > 8.1
#### Laravel > 9.36.4
#### MYSQL > 8.0

## How to install this project

To do that, at first you should set your env variables,
for this part you can use this command:
#### cp .env.example .env

Then you should run this command 
#### composer install

next you can run the containers with this command
#### docker-compose up -d --build

After setting the variables you should run migration with this command:
#### docker exec -it backend php artisan migrate

Then run the seeder with this command:
#### docker exec -it backend php artisan migrate php artisan db:seed

Finally run this command to serve the project
#### php artisan serve

## API documentation
You can see the api documentation via curls, to see that you should go thorough the public folder and see them

## Tests

To run the tests, at first you should set env variables in .env.testing
to do that you can run this command:
#### cp .env.testing.example .env.testing

ok cool, now you can run the tests with this command
#### php artisan test


## The end
I hope you enjoy from this project, please tell me your points about this project.

#### Amir Zandieh
#### Amirzandieh1@gamil.com

#### Thanks
