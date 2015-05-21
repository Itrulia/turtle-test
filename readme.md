# Turtle Test

[![Build Status](https://travis-ci.org/Itrulia/turtle-test.svg?branch=master)](https://travis-ci.org/Itrulia/turtle-test) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Itrulia/turtle-test/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Itrulia/turtle-test/?branch=master)

This is an entry test for the company Turtle Entertainment GmbH

## Install

If PHP/Apache is not yet installed, but vagrant is:

1. `git clone` the repository
2. `cd` in to the repository
3. Start the machine with `vagrant up`
4. Wait until the setup finished
5. SSH in to the machine with `vagrant ssh`
6. `cd` in to `/var/www/battleborn`
7. `composer install` the dependencies.
8. visit `localhost:8888` on the host machine.

If PHP/Apache is installed

1. `git clone` the repository
2. `mv` it to an accessible directory
3. `cd` in to it
4. `composer install` the dependencies.
5. visit the virtualhost + `turtle-test/public`

## Why I used so many interfaces

> You'll never know when you need another implementation 

This is something I always keep in mind. Maybe I need to access the API from a SOAP service. This is why I stick to the [SOLID](http://en.wikipedia.org/wiki/SOLID_%28object-oriented_design%29) principles. 

Also, when you use Laravel you can easily switch which implementation the IoC container will resolve.


## What the `Gateways` do

The gateways fetch data from the servers and call the factories.

## What the `Factories` do

The factories creates a model and populate the the properties.

## What the `Fetcher` does

The lonely `FetchBrackets` class creates the brackets and populates them. This is basically the business logic of the application.

If you want to add features to the application, you most likely will do it here. 

## What the `Models` do

Well the models are holding data. But they have some magic behind them.

On a model you can always call`$model->getId();` or `$model->setId(1);`; Or you can access them directly via `$model->id` or `$model->id = 1` even when the model has no property called `id`. This is because of the way I use [magic methods](http://php.net/manual/en/language.oop5.magic.php).

But what if you want to create a setter? No problem.

Inside the class, just create a method with the following syntax:

````php
protected function setIdAttribute($aAttribute) {
  // change $aAttribute here
  $this->data['id'] = $aAttribute;
}
````

The same goes for a getter:

````php
protected function getIdAttribute() {
   $data = $this->data['id'];
   // do your stuff here
   return $data;
}
````

Those get called behind the curtains when you call the described methods above.

## Tests

I run the tests on every `git push` with Travis. You can see the results [here](https://travis-ci.org/Itrulia/turtle-test).

If you want to run them yourself, just `cd` in to the repository and call `phpunit`.
