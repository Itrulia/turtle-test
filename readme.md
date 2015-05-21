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
